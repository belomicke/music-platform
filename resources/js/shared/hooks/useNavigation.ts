import { RouteParamsRawGeneric, useRouter } from "vue-router"
import { ROUTE_NAME } from "@/shared/config"

export const useNavigation = () => {
    const router = useRouter()

    const goTo = async (name: ROUTE_NAME, params?: RouteParamsRawGeneric) => {
        await router.push({
            name,
            params: params,
        })
    }

    const goToHomePage = async () => {
        await goTo("home")
    }

    const goToSearchPage = async () => {
        await goTo("search")
    }

    const goToCollectionPage = async () => {
        await goTo("collection")
    }

    const goToSignInPage = async () => {
        await goTo("sign-in")
    }

    const goToSignUpPage = async () => {
        await goTo("sign-up")
    }

    const goToFavoriteArtistsPage = async () => {
        await goTo("favorite-artists")
    }

    const goToFavoriteReleasesPage = async () => {
        await goTo("favorite-releases")
    }

    const goToFavoriteTracksPage = async () => {
        await goTo("favorite-tracks")
    }

    const goToArtistInfoPage = async (id: string) => {
        await goTo("artist-info", {
            id,
        })
    }

    const goToArtistReleasesPage = async (id: string) => {
        await goTo("artist-releases", {
            id,
        })
    }

    const goToReleaseInfoPage = async (id: string) => {
        await goTo("release-info", {
            id,
        })
    }

    return {
        goToHomePage,
        goToSearchPage,
        goToCollectionPage,

        goToSignInPage,
        goToSignUpPage,

        goToFavoriteArtistsPage,
        goToFavoriteReleasesPage,
        goToFavoriteTracksPage,

        goToArtistInfoPage,
        goToArtistReleasesPage,

        goToReleaseInfoPage,
    }
}
