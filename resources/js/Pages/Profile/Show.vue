<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Мой профиль
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                            <div class="md:col-span-1">
                                <div class="rounded-lg bg-gray-50 p-6 shadow">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-blue-500 text-3xl text-white"
                                        >
                                            {{ userInitials }}
                                        </div>
                                        <h3
                                            class="text-lg font-medium text-gray-900"
                                        >
                                            {{ user.name || '' }}
                                            {{ user.last_name || '' }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            {{ user.email }}
                                        </p>
                                        <p class="mt-2 text-sm text-gray-500">
                                            {{ user.phone_number }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-3">
                                <!-- Доступные билеты -->
                                <div
                                    class="mb-8 rounded-lg bg-gray-50 p-6 shadow"
                                >
                                    <h3
                                        class="mb-4 text-lg font-medium text-gray-900"
                                    >
                                        Доступные билеты
                                    </h3>

                                    <div
                                        v-if="
                                            availableTickets.data.length === 0
                                        "
                                        class="border-l-4 border-blue-400 bg-blue-50 p-4"
                                    >
                                        <div class="flex items-center">
                                            <InformationCircleIcon
                                                class="mr-3 h-5 w-5 text-blue-400"
                                            />
                                            <p class="text-sm text-blue-700">
                                                Нет доступных билетов для
                                                покупки.
                                            </p>
                                        </div>
                                    </div>

                                    <div v-else>
                                        <div class="overflow-x-auto">
                                            <table
                                                class="min-w-full divide-y divide-gray-200"
                                            >
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Фильм
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Дата и время
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Зал
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Свободные места
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Действия
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="divide-y divide-gray-200 bg-white"
                                                >
                                                    <tr
                                                        v-for="schedule in availableTickets.data"
                                                        :key="schedule.id"
                                                    >
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            <div
                                                                class="font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    schedule
                                                                        .movie
                                                                        .title
                                                                }}
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                formatDateTime(
                                                                    schedule.start_time,
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                schedule.hall
                                                                    .name
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                schedule.available_seats
                                                            }}
                                                            из
                                                            {{
                                                                schedule.hall
                                                                    .capacity
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            <button
                                                                @click="
                                                                    showSeatSelection(
                                                                        schedule,
                                                                    )
                                                                "
                                                                class="text-indigo-600 hover:text-indigo-900"
                                                            >
                                                                Выбрать место
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-4 flex justify-center">
                                            <pagination
                                                :links="availableTickets.links"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- История покупок -->
                                <div class="rounded-lg bg-gray-50 p-6 shadow">
                                    <h3
                                        class="mb-4 text-lg font-medium text-gray-900"
                                    >
                                        История покупок
                                    </h3>

                                    <div
                                        v-if="tickets.data.length === 0"
                                        class="border-l-4 border-blue-400 bg-blue-50 p-4"
                                    >
                                        <div class="flex items-center">
                                            <InformationCircleIcon
                                                class="mr-3 h-5 w-5 text-blue-400"
                                            />
                                            <p class="text-sm text-blue-700">
                                                У вас пока нет купленных
                                                билетов.
                                            </p>
                                        </div>
                                    </div>

                                    <div v-else>
                                        <div class="overflow-x-auto">
                                            <table
                                                class="min-w-full divide-y divide-gray-200"
                                            >
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Фильм
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Дата и время
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Зал
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Место
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                                        >
                                                            Статус
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="divide-y divide-gray-200 bg-white"
                                                >
                                                    <tr
                                                        v-for="ticket in tickets.data"
                                                        :key="ticket.id"
                                                    >
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            <div
                                                                class="font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    ticket
                                                                        .schedule
                                                                        .movie
                                                                        .title
                                                                }}
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                formatDateTime(
                                                                    ticket
                                                                        .schedule
                                                                        .start_time,
                                                                )
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                ticket.schedule
                                                                    .hall.name
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            Ряд
                                                            {{
                                                                ticket.hall_seat
                                                                    .row
                                                            }}, Место
                                                            {{
                                                                ticket.hall_seat
                                                                    .seat_number
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            <span
                                                                class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800"
                                                            >
                                                                Активен
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-4 flex justify-center">
                                            <pagination
                                                :links="tickets.links"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно выбора места -->
        <modal :show="showSeatModal" @close="showSeatModal = false">
            <div class="p-6">
                <h2 class="mb-4 text-lg font-medium text-gray-900">
                    Выберите место для: {{ selectedSchedule?.movie?.title }}
                </h2>

                <div class="mb-6 grid grid-cols-12 gap-2">
                    <div
                        v-for="seat in availableSeats"
                        :key="seat.id"
                        class="cursor-pointer rounded border p-2 text-center"
                        :class="{
                            'bg-green-100': !selectedSeats.includes(seat.id),
                            'bg-blue-100': selectedSeats.includes(seat.id),
                        }"
                        @click="toggleSeat(seat.id)"
                    >
                        Ряд {{ seat.row }}, Место {{ seat.seat_number }}
                    </div>
                </div>

                <div class="flex justify-end">
                    <button
                        @click="buyTickets"
                        class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                        :disabled="selectedSeats.length === 0"
                    >
                        Купить выбранные места
                    </button>
                </div>
            </div>
        </modal>
    </app-layout>
</template>

<script>
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { InformationCircleIcon } from '@heroicons/vue/24/outline';

export default {
    components: {
        AppLayout,
        Pagination,
        Modal,
        InformationCircleIcon,
    },

    props: {
        user: Object,
        tickets: Object,
        availableTickets: Object,
    },

    data() {
        return {
            showSeatModal: false,
            selectedSchedule: null,
            availableSeats: [],
            selectedSeats: [],
        };
    },

    computed: {
        userInitials() {
            const first = this.user.name?.charAt(0) || '';
            const last = this.user.last_name?.charAt(0) || '';
            return (first + last).toUpperCase();
        },
    },

    methods: {
        formatDateTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('ru-RU', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            });
        },

        async showSeatSelection(schedule) {
            this.selectedSchedule = schedule;
            try {
                const response = await axios.get(
                    `/api/schedules/${schedule.id}/available-seats`,
                );
                this.availableSeats = response.data;
                this.showSeatModal = true;
            } catch (error) {
                console.error('Error fetching available seats:', error);
            }
        },

        toggleSeat(seatId) {
            if (this.selectedSeats.includes(seatId)) {
                this.selectedSeats = this.selectedSeats.filter(
                    (id) => id !== seatId,
                );
            } else {
                this.selectedSeats.push(seatId);
            }
        },

        async buyTickets() {
            try {
                await axios.post('/api/tickets', {
                    schedule_id: this.selectedSchedule.id,
                    seats: this.selectedSeats,
                });

                this.showSeatModal = false;
                this.$inertia.reload();
            } catch (error) {
                console.error('Error buying tickets:', error);
            }
        },
    },
};
</script>
