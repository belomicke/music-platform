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

    "entities": {
        "release": {
            "single": "Релиз",
            "plural": "Релизы",
            "types": {
                "album": "Альбом",
                "single": "Сингл",
            },
        },
        "artist": {
            "single": "Исполнитель",
            "plural": "Исполнители",
        },
    },

    "ui": {
        "dialog": {
            "action": {
                "cancel": "Отмена",
            },
        },
    },

    "features": {
        "me": {
            "edit-account-info": {
                "ui": {
                    "modal": {
                        "title": "Ваши данные",
                        "inputs": {
                            "name": {
                                "label": "Как к вам обращаться?",
                                "placeholder": "Публичное имя",
                            },
                        },
                        "buttons": {
                            "submit": {
                                "text": "Сохранить",
                            },
                        },
                    },
                },
                "errors": {
                    "invalid-type": "Файл не является изображением",
                    "invalid-size": "Размер файла не должен превышать 2 MB",
                },
            },
        },
        "collection": {
            "followed-artists": {
                "ui": {
                    "list-title": "Любимые исполнители",
                },
            },
            "followed-releases": {
                "ui": {
                    "list-title": "Любимые релизы",
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
        "search": {
            "input": {
                "placeholder": "Трек, альбом, исполнитель",
            },
            "recent-searches": {
                "note": "Здесь будут ваши недавние запросы",
                "clear": "Очистить историю",
            },
            "no-results": {
                "title": "Ничего не нашли",
                "text": "Попробуйте написать по-другому",
            },
        },
        "artist-info": {
            "header": {
                "type": "Исполнитель",
            },
        },
        "release": {
            "info": {
                "header": {
                    "type": "Альбом",
                },
            },
        },
        "collection": {
            "followed-artists": {
                "header": {
                    "title": "Исполнители",
                },
            },
            "followed-releases": {
                "header": {
                    "title": "Релизы",
                },
            },
        },
    },

    "followers": "0 подписчиков | 1 подписчик | {count} подписчика | {count} подписчиков",

    "layouts": {
        "app": {
            "sidebar": {
                "navigation": {
                    "options": {
                        "home": "Главная",
                        "search": "Поиск",
                        "collection": "Коллекция",
                    },
                },
                "footer": {
                    "auth-buttons": {
                        "sign-in": "Войти",
                        "sign-up": "Зарегистрироваться",
                    },
                    "dropdown": {
                        "dialogs": {
                            "log-out": {
                                "title": "Выход",
                                "message": "Вы действительно хотите выйти?",
                                "confirm-button-text": "Выйти",
                            },
                        },
                        "options": {
                            "edit-account-info": "Настройки профиля",
                            "log-out": "Выйти из аккаунта",
                        },
                    },
                },
            },
        },
    },
}
