import type { CreateUserDTO, CurrentUserResponse, ResetPasswordDTO, SignInDTO, StatusResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const authMethods = {
    createUser: async (data: CreateUserDTO): Promise<CurrentUserResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/auth/sign-up",
            data,
        })
    },
    login: async (data: SignInDTO): Promise<CurrentUserResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/auth/sign-in",
            data,
        })
    },
    logout: async (): Promise<StatusResponse> => {
        return await makeRequest({
            method: "DELETE",
            url: "/api/auth/log-out",
        })
    },
    sendEmailVerificationMail: async (email: string): Promise<StatusResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/auth/email-verification-code",
            data: {
                email,
            },
        })
    },
    forgotPassword: async (email: string): Promise<StatusResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/auth/forgot-password",
            data: {
                email,
            },
        })
    },
    resetPassword: async (data: ResetPasswordDTO): Promise<StatusResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/auth/reset-password",
            data,
        })
    },
}
