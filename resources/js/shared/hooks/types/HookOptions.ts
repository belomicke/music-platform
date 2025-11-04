import { ApiErrorResponse } from "@/shared/api"

export interface HookOptions {
    onError: (err: ApiErrorResponse) => void
}
