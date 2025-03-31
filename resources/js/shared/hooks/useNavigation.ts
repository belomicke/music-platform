import { useRouter } from "vue-router"
import { ROUTE_NAMES } from "@/shared/config/router"

export const useNavigation = () => {
    const router = useRouter()

    const goToHomePage = async () => {
        await router.push({
            name: ROUTE_NAMES.HOME,
        })
    }

    const goToSignInPage = async () => {
        await router.push({
            name: ROUTE_NAMES.SIGN_IN,
        })
    }

    const goToSignUpPage = async () => {
        await router.push({
            name: ROUTE_NAMES.SIGN_UP,
        })
    }

    const goToProfilePage = async (id: string) => {
        await router.push({
            name: ROUTE_NAMES.PROFILE_PAGE,
            params: {
                id,
            },
        })
    }

    return {
        goToHomePage,
        goToSignInPage,
        goToSignUpPage,
        goToProfilePage,
    }
}
