export interface ResetPasswordDTO {
    token: string
    email: string
    password: string
    password_confirmation: string
}
