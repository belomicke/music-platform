import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { meMethods } from "./me"
import { usersMethods } from "./users"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    me: meMethods,
    users: usersMethods,
}
