import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router"
import { AppLayout, AuthLayout } from "../layouts"
import {
    ArtistInfoPage,
    CollectionPage,
    FavoriteArtistsPage,
    ForgotPasswordPage,
    HomePage,
    ResetPasswordPage,
    SearchPage,
    SignInPage,
    SignUpPage,
} from "@/pages"
import { ROUTE_NAMES, ROUTE_NAMES_ONLY_FOR_GUESTS } from "@/shared/config/router"

const routes: RouteRecordRaw[] = [
    {
        path: "/auth/",
        component: AuthLayout,
        children: [
            {
                path: "sign-up",
                component: SignUpPage,
                name: ROUTE_NAMES.SIGN_UP,
            },
            {
                path: "sign-in",
                component: SignInPage,
                name: ROUTE_NAMES.SIGN_IN,
            },
            {
                path: "reset-password",
                component: ResetPasswordPage,
                name: ROUTE_NAMES.RESET_PASSWORD,
            },
            {
                path: "forgot-password",
                component: ForgotPasswordPage,
                name: ROUTE_NAMES.FORGOT_PASSWORD,
            },
        ],
    },

    {
        path: "/",
        component: AppLayout,
        children: [
            {
                path: "/",
                component: HomePage,
                name: ROUTE_NAMES.HOME,
            },
            {
                path: "/search",
                component: SearchPage,
                name: ROUTE_NAMES.SEARCH,
            },
            {
                path: "/collection",
                children: [
                    {
                        path: "",
                        component: CollectionPage,
                        name: ROUTE_NAMES.COLLECTION,
                    },
                    {
                        path: "artists",
                        component: FavoriteArtistsPage,
                        name: ROUTE_NAMES.FAVOURITE_ARTISTS_PAGE,
                    },
                ],
            },
            {
                path: "/artist/",
                children: [
                    {
                        path: ":id",
                        component: ArtistInfoPage,
                        name: ROUTE_NAMES.ARTIST_INFO_PAGE,
                    },
                ],
            },
        ],
    },

    {
        path: "/:pathMatch(.*)",
        redirect: "/",
    },
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, _, next) => {
    const isAuth = localStorage.getItem("user") !== null

    if (isAuth) {
        if (ROUTE_NAMES_ONLY_FOR_GUESTS.indexOf(to.name as string) !== -1) {
            return next({
                name: ROUTE_NAMES.HOME,
            })
        }
    } else {
        if (to.path.startsWith("/collection")) {
            return next({
                name: ROUTE_NAMES.HOME,
            })
        }
    }

    return next()
})
