import { IUser } from "./User"

export interface ICurrentUser extends IUser {
    email: string
}
