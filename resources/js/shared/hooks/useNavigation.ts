import { useRouter } from "vue-router"
import { ROUTE_NAMES } from "@/shared/config/router"

export const useNavigation = () => {
    const router = useRouter()

    const goToHomePage = () => {
        router.push({
            name: ROUTE_NAMES.HOME,
        })
    }

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

    const goToUserInfoPage = (id: string) => {
        router.push({
            name: ROUTE_NAMES.USER_INFO_PAGE,
            params: {
                id,
            },
        })
    }

    const goToUserFollowedArtistsPage = (id: string) => {
        router.push({
            name: ROUTE_NAMES.USER_FOLLOWING_PAGE,
            params: {
                id,
            },
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
        goToSignInPage,
        goToSignUpPage,

        goToUserInfoPage,
        goToUserFollowedArtistsPage,

        goToArtistInfoPage,
    }
}
