<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex items-center">
                        <InertiaLink
                            :href="route('home')"
                            class="text-xl font-semibold text-gray-900"
                        >
                            КиноПоиск
                        </InertiaLink>
                    </div>

                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <InertiaLink
                            :href="route('movie.list')"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                        >
                            Фильмы
                        </InertiaLink>

                        <div class="relative ml-3">
                            <div
                                v-if="$page.props.auth.user"
                                class="flex items-center"
                            >
                                <InertiaLink
                                    :href="route('profile.show')"
                                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                >
                                    Мой профиль
                                </InertiaLink>

                                <form @submit.prevent="logout" class="ml-3">
                                    <button
                                        type="submit"
                                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        Выйти
                                    </button>
                                </form>
                            </div>

                            <div v-else class="flex items-center">
                                <InertiaLink
                                    :href="route('login')"
                                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                >
                                    Войти
                                </InertiaLink>
                                <InertiaLink
                                    :href="route('register')"
                                    class="ml-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                                >
                                    Регистрация
                                </InertiaLink>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header v-if="$slots.header" class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <main class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <slot />
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Link as InertiaLink } from '@inertiajs/vue3';

export default {
    components: {
        InertiaLink,
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
};
</script>

<style>
.min-h-screen {
    min-height: 100vh;
}
.bg-gray-100 {
    background-color: #f7fafc;
}
.shadow-sm {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.max-w-7xl {
    max-width: 80rem;
}
.mx-auto {
    margin-left: auto;
    margin-right: auto;
}
.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}
</style>
