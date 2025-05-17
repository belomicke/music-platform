<?php

declare(strict_types=1);

namespace App\Actions\Search\RecentSearch;

use App\DTOs\RecentSearch\RecentSearchDTO;
use App\Models\Artist;
use App\Models\RecentSearch;
use App\Models\Release;
use App\Repositories\ArtistRepository;
use App\Repositories\ReleaseRepository;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final readonly class GetRecentSearchesAction
{
    public function __construct(
        private ArtistRepository  $artists,
        private ReleaseRepository $releases
    ) {}

    /**
     * @return Collection<RecentSearchDTO>
     */
    public function execute(): Collection
    {
        $recentSearches = $this->getRecentSearches();

        $artists = $this->getArtists(recentSearches: $recentSearches);
        $releases = $this->getReleases(recentSearches: $recentSearches);

        $data = new Collection();

        foreach ($recentSearches as $recentSearch) {
            $type = $recentSearch->type;
            $uuid = $recentSearch->uuid;

            if ($type === "artist") {
                $data->add(new RecentSearchDTO(
                    data: $artists->where("uuid", $uuid)->first(),
                    type: $type
                ));
            } else if ($type === "release") {
                $data->add(new RecentSearchDTO(
                    data: $releases->where("uuid", $uuid)->first(),
                    type: $type
                ));
            }
        }

        return $data;
    }

    /**
     * @return Collection<RecentSearch>
     */
    private function getRecentSearches(): Collection
    {
        $user = AuthService::user();

        return $user
            ->recent_searches()
            ->orderBy("id", "desc")
            ->get();
    }

    /**
     * @return Collection<Artist>
     */
    private function getArtists(Collection $recentSearches): Collection
    {
        $artistRecentSearches = $recentSearches->filter(function (RecentSearch $item) {
            return $item->type === "artist";
        });

        $ids = $artistRecentSearches->pluck("uuid")->toArray();

        return $this->artists->getManyByUUID($ids);
    }

    /**
     * @return Collection<Release>
     */
    private function getReleases(Collection $recentSearches): \Illuminate\Support\Collection
    {
        $releaseRecentSearches = $recentSearches->filter(function (RecentSearch $item) {
            return $item->type === "release";
        });

        $ids = $releaseRecentSearches->pluck("uuid")->toArray();

        return $this->releases->getManyByUUID($ids);
    }
}
