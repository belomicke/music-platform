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
            name: ROUTE_NAMES.USER_FOLLOWED_ARTISTS_PAGE,
            params: {
                id,
            },
        })
    }

    const goToUserFollowedUsersPage = (id: string) => {
        router.push({
            name: ROUTE_NAMES.USER_FOLLOWED_USERS_PAGE,
            params: {
                id,
            },
        })
    }

    const goToUserFollowersPage = (id: string) => {
        router.push({
            name: ROUTE_NAMES.USER_FOLLOWERS_PAGE,
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
        goToUserFollowedUsersPage,
        goToUserFollowersPage,

        goToArtistInfoPage,
    }
}
