<template>
    <div v-if="links.length > 3" class="mt-4 flex items-center justify-between">
        <div class="flex flex-1 justify-between sm:hidden">
            <button
                v-if="links[0].url"
                @click="selectPage(links[0].url)"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Назад
            </button>
            <button
                v-if="links[links.length - 1].url"
                @click="selectPage(links[links.length - 1].url)"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Вперед
            </button>
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Показано с <span class="font-medium">{{ from }}</span> по
                    <span class="font-medium">{{ to }}</span> из
                    <span class="font-medium">{{ total }}</span> результатов
                </p>
            </div>
            <div>
                <nav
                    class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
                    aria-label="Pagination"
                >
                    <button
                        v-for="(link, index) in links"
                        :key="index"
                        @click="selectPage(link.url)"
                        v-html="link.label"
                        class="relative inline-flex items-center whitespace-nowrap border px-4 py-2 text-sm font-medium"
                        :class="{
                            'z-10 border-indigo-500 bg-indigo-50 text-indigo-600':
                                link.active,
                            'border-gray-300 bg-white text-gray-500 hover:bg-gray-50':
                                !link.active && link.url,
                            'cursor-not-allowed border-gray-300 bg-white text-gray-300':
                                !link.url,
                        }"
                        :disabled="!link.url"
                    />
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: {
            type: Array,
            required: true,
        },
        from: {
            type: Number,
            required: true,
        },
        to: {
            type: Number,
            required: true,
        },
        total: {
            type: Number,
            required: true,
        },
    },
    methods: {
        selectPage(url) {
            if (url) {
                const page = new URL(url).searchParams.get('page');
                this.$inertia.get(url, { page });
            }
        },
    },
};
</script>
