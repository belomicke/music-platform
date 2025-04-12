import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { usersMethods } from "./users"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    users: usersMethods,
}
