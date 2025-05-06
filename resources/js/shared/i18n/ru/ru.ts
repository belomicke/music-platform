export default {
    "auth": {
        "dialog": {
            "title": {
                "log-out": "Music Platform",
            },
            "message": {
                "log-out": "Вы действительно хотите выйти?",
            },
            "action": {
                "log-out": "Выход",
            },
        },
        "errors": {
            "invalid-credentials": "Неверный адрес электронной почты или пароль.",
            "expired-token": "Время действия истекло.",
        },
        "form": {
            "title": {
                "success": "Успех",
                "sign-in": "Вход",
                "sign-up": "Создание аккаунта",
                "email-verification": "Подтверждение почты",
                "forgot-password": "Восстановление пароля",
                "reset-password": "Создание пароля",
            },
            "text": {
                "recall-your-password": "Вспомнили пароль?",
                "already-have-an-account": "Уже есть аккаунт?",
                "dont-have-an-account": "Ещё нет аккаунта?",
                "reset-password-mail-was-sent": "Вам на почту было отправлено письмо для сброса пароля.",
                "you-can-close-this-page-now": "Вы можете закрыть эту страницу.",
            },
        },
        "button": {
            "text": {
                "log-out": "Выйти",
                "sign-up": "Регистрация",
                "sign-in": "Войти",
                "next": "Далее",
                "back": "Назад",
                "forgot-password": "Забыли пароль?",
            },
            "action": {
                "sign-up": "Создать аккаунт",
                "sign-in": "Войти",
                "forgot-password": "Получить письмо",
                "reset-password": "Сменить пароль",
            },
        },
        "input": {
            "label": {
                "email": "Эл. адрес",
                "name": "Отображаемое имя",
                "password": "Пароль",
                "confirm-password": "Подтверждение пароля",
                "verification-code": "Код подтверждения",
            },
            "placeholder": {
                "email": "email{'@'}example.com",
                "name": "Отображаемое имя",
                "password": "Пароль",
                "confirm-password": "Подтверждение пароля",
                "verification-code": "Код подтверждения",
            },
        },
    },

    "ui": {
        "dialog": {
            "action": {
                "cancel": "Отмена",
            },
        },
        "media-card": {
            "type": {
                "artist": "Исполнитель",
                "user": "Профиль",
            },
        },
    },

    "features": {
        "artist": {
            "following": {
                "button-text": {
                    "follow": "Подписаться",
                    "unfollow": "Уже подписаны",
                },
            },
        },
        "user": {
            "following": {
                "button-text": {
                    "follow": "Подписаться",
                    "unfollow": "Уже подписаны",
                },
            },
            "user-followed-users": {
                "ui": {
                    "users-list-title": "Подписки на пользователей",
                },
            },
            "user-followed-artists": {
                "ui": {
                    "artists-list-title": "Подписки на исполнителей",
                },
            },
        },
    },

    "page": {
        "home": {
            "section-title": {
                "popular-artists": "Популярные исполнители",
            },
        },
        "artist-info": {
            "header": {
                "type": "Исполнитель",
                "subtitle": "{followers} подписчиков",
            },
        },
        "user": {
            "info-page": {
                "header": {
                    "type": "Профиль",
                },
            },
            "followed-artists": {
                "header": {
                    "title": "Исполнители на которых подписан {name}",
                },
            },
            "followed-users": {
                "header": {
                    "title": "Пользователи на которых подписан {name}",
                },
            },
            "followers": {
                "header": {
                    "title": "Пользователи которые подписаны на {name}",
                },
            },
        },
    },

    "followers": "0 подписчиков | {n} подписчик | {n} подписчика | {n} подписчиков",

    "layouts": {
        "app": {
            "header": {
                "auth-user-dropdown": {
                    "user-profile": "Профиль",
                    "log-out": "Выход",
                },
            },
        },
    },
}
