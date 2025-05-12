import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { meMethods } from "./me"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    me: meMethods,
}
