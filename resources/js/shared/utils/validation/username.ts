export const MIN_USERNAME_LENGTH = 4
export const MAX_USERNAME_LENGTH = 32

export const isUsernameValid = (username: string) => {
    return username.length >= MIN_USERNAME_LENGTH
        && username.length <= MAX_USERNAME_LENGTH
}
