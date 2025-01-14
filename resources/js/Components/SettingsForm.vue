<!-- resources/js/components/SettingsComponent.vue -->

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Настройки пользователя</h2>
            <ul v-if="Object.keys(settings).length > 0" class="mt-6 space-y-2">
                <li v-for="(value, key) in settings" :key="key">
                    <strong>{{ key }}:</strong> {{ value }}
                </li>
            </ul>
            <div v-else class="mt-1 text-sm text-gray-600">
                Не определено ни одной настройки
            </div>
        </header>
        <div v-if="!isConfirmed" class="mt-12 space-y-6">
            <h2 class="text-lg font-medium text-gray-900">Изменить настройку</h2>
            <form @submit.prevent="requestChange" class="mt-6 space-y-6">
                <div class="form-group">
                    <InputLabel for="key">Ключ настройки</InputLabel>
                    <TextInput v-model="formA.key" type="text" class="form-control w-full" id="key" required/>
                </div>
                <div class="form-group">
                    <InputLabel for="value">Новое значение</InputLabel>
                    <TextInput v-model="formA.value" type="text" class="form-control w-full" id="value" required/>
                </div>
                <div class="form-group">
                    <InputLabel for="method">Метод подтверждения</InputLabel>
                    <select v-model="formA.method" class="form-control w-full" id="method" required>
                        <option value="email">Email</option>
                        <option value="sms">SMS</option>
                        <option value="telegram">Telegram</option>
                    </select>
                </div>
                <PrimaryButton type="submit" class="btn btn-primary">Изменить</PrimaryButton>
            </form>
        </div>
        <div v-else class="mt-12 space-y-6">
            <h2 class="text-lg font-medium text-gray-900">Подтвердить изменение</h2>
            <form @submit.prevent="confirmChange" class="mt-6 space-y-6">
                <div class="form-group">
                    <InputLabel for="code">Код подтверждения</InputLabel>
                    <TextInput v-model="formB.code" type="text" class="form-control w-full" id="code" required/>
                </div>
                <div class="flex gap-4">
                    <SecondaryButton @click="this.isConfirmed = false">Вернуться</SecondaryButton>
                    <PrimaryButton type="submit" class="btn btn-success">Подтвердить</PrimaryButton>
                </div>
            </form>
        </div>
        <div v-if="responseCode && isConfirmed" class="md:absolute md:top-0 md:right-1 p-2 flex flex-col items-end">
            <h3 class="text-lg font-medium text-gray-900">Код подтверждения:</h3>
            <div>
                {{ responseCode }}
            </div>
        </div>
    </section>
</template>

<script>
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    components: {SecondaryButton, PrimaryButton, InputLabel, TextInput},
    data() {
        return {
            settings: {},
            isConfirmed: false,
            responseCode: null,
            formA: useForm({
                key: '',
                value: '',
                method: 'email',
            }),
            formB: useForm({
                code: '',
            }),
        };
    },
    methods: {
        fetchSettings() {
            axios.get('/settings')
                .then(response => {
                    this.settings = response.data;
                });
        },
        requestChange() {
            axios.post('/settings/request-change', {
                key: this.formA.key,
                value: this.formA.value,
                method: this.formA.method,
            })
                .then(response => {
                    this.isConfirmed = true
                    this.responseCode = response.data
                    alert('Код подтверждения отправлен.');
                })
                .catch(error => {
                    console.error(error);
                });
        },
        confirmChange() {
            axios.post('/settings/confirm-change', {
                code: this.formB.code,
            })
                .then(response => {
                    this.isConfirmed = false
                    this.responseCode = null
                    alert('Настройка успешно изменена.');
                    this.fetchSettings();
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
    mounted() {
        this.fetchSettings();
    },
};
</script>

<style scoped>
/* Стили компонента */
</style>

