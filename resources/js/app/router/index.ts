import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router"
import { AppLayout, AuthLayout } from "../layouts"
import { ForgotPasswordPage, HomePage, ProfilePage, ResetPasswordPage, SignInPage, SignUpPage } from "@/pages"
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
                path: "/profile/:id",
                component: ProfilePage,
                name: ROUTE_NAMES.PROFILE_PAGE,
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
    }

    return next()
})
