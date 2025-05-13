import { useRouter } from "vue-router"
import { ROUTE_NAMES } from "@/shared/config/router"

export const useNavigation = () => {
    const router = useRouter()

    const goToHomePage = () => {
        router.push({
            name: ROUTE_NAMES.HOME,
        })
    }

    const goToSearchPage = () => {
        router.push({
            name: ROUTE_NAMES.SEARCH,
        })
    }

    const goToCollectionPage = (() => {
        router.push({
            name: ROUTE_NAMES.COLLECTION,
        })
    })

    const goToSignInPage = () => {
        router.push({
            name: ROUTE_NAMES.SIGN_IN,
        })
    }

    const goToSignUpPage = () => {
        router.push({
            name: ROUTE_NAMES.SIGN_UP,
        })
    }

    const goToFavoriteArtistsPage = () => {
        router.push({
            name: ROUTE_NAMES.FAVOURITE_ARTISTS_PAGE,
        })
    }

    const goToArtistInfoPage = (id: string) => {
        router.push({
            name: ROUTE_NAMES.ARTIST_INFO_PAGE,
            params: {
                id,
            },
        })
    }

    return {
        goToHomePage,
        goToSearchPage,
        goToCollectionPage,

        goToSignInPage,
        goToSignUpPage,

        goToFavoriteArtistsPage,

        goToArtistInfoPage,
    }
}
