import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router"
import { AppLayout, AuthLayout } from "../layouts"
import {
    ArtistInfoPage,
    ForgotPasswordPage,
    HomePage,
    ResetPasswordPage,
    SignInPage,
    SignUpPage,
    UserFollowedArtistsPage,
    UserFollowedUsersPage,
    UserFollowersPage,
    UserInfoPage,
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
                path: "/user/:id",
                children: [
                    {
                        path: "",
                        component: UserInfoPage,
                        name: ROUTE_NAMES.USER_INFO_PAGE,
                    },
                    {
                        path: "followed-artists",
                        component: UserFollowedArtistsPage,
                        name: ROUTE_NAMES.USER_FOLLOWED_ARTISTS_PAGE,
                    },
                    {
                        path: "followed-users",
                        component: UserFollowedUsersPage,
                        name: ROUTE_NAMES.USER_FOLLOWED_USERS_PAGE,
                    },
                    {
                        path: "followers",
                        component: UserFollowersPage,
                        name: ROUTE_NAMES.USER_FOLLOWERS_PAGE,
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

    // {
    //     path: "/:pathMatch(.*)",
    //     redirect: "/",
    // },
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
    }

    return next()
})
