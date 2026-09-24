<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router, usePage, useForm } from '@inertiajs/vue3'
import {ref} from 'vue';


defineProps({
    messages: Array,
})
const page = usePage()
const authUser = page.props.auth.user

const form = useForm({
    message: '',
})


const editingId = ref(null)
const editMessage = ref('')

const submit = ()=>{
    form.post(route('chat.store'),{
        onSuccess: ()=>form.reset(),
    })
}


const startEdit = (msg)=>{
            editingId.value = msg.id
            editMessage.value = msg.message
}


const updateMessage = (id)=>{
    router.put(route('chat.update',id),{
        message:editMessage.value},
        {onSuccess: ()=>{
            editingId.value = null
            editMessage.value = ''
        },
    })
}

const canselEdit =()=>{
    editingId.value = null
    editMessage.value = ''
}


const deleteMessage = (id)=>{
    if(confirm('Удалить сообщение?')){
        router.delete(route('chat.destroy',id))
    }
}
</script>

<template>
    <Head title="Чат" />

    <AuthenticatedLayout>
        <div class="chat-page">
            <h2>Чат</h2>

            <div class="chat-box">
                <div v-if="messages.length">
                    <div v-for="msg in messages" :key="msg.id
" class="message-item">
                        <div class="message-user">
                            {{ msg.user.name
 }}
                        </div>


                        <div v-if="editingId === msg.id">
                            <textarea class="chat-input" v-model="editMessage"></textarea>
                            <div class="message-actions">

                                        <button class="save-btn" @click="updateMessage(msg.id)">Сохранить</button>
                                        <button class="cansel-btn" @click="canselEdit">Отменить</button>

                            </div>

                        </div>

                        <div class="message-text">
                            {{ msg.message }}
                        </div>

                        
                        
                        
                        
                        <div class="message-actions"
                        v-if ='authUser && authUser.id == msg.user_id'
                        
                        >

                            <button class="edit-btn" @click="startEdit(msg)">Редактировать</button>
                            <button class="delete-btn" @click="deleteMessage(msg.id)">Удалить</button>

                        </div>


                    </div>
                </div>

                <div v-else>
                    Пока нет сообщений
                </div>
            </div>

            <form @submit.prevent="submit" class="chat-form">
                <textarea v-model="form.message" class="chat-input"></textarea>

                <div v-if="form.errors.message" class="error">
                    {{ form.errors.message }}
                </div>

                <button type="submit" class="chat-button">
                    Отправить
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.chat-page {
    max-width: 900px;
    margin: 30px auto;
    padding: 0 20px;
}

.chat-box {
    border: 1px solid #ddd;
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
}

.message-item {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.message-item:last-child {
    border-bottom: none;
}

.message-user {
    font-weight: bold;
    margin-bottom: 6px;
}

.message-text {
    color: #333;
}

.chat-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.chat-input {
    min-height: 100px;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 12px;
}

.chat-button {
    width: 160px;
    background: #111827;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 10px;
    cursor: pointer;
}

.error {
    color: red;
}


.message-actions{
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.edit-btn{
    background: #2563ed;
    color:white;
    border: none;
    padding: 8px 10px;
    border-radius: 10px;
}

.delete-btn{
    background: #ed2525;
    color:white;
    border: none;
    padding: 8px 10px;
    border-radius: 10px;
}

.save-btn{
    background: #86ed25;
    color:white;
    border: none;
    padding: 4px 7px;
    border-radius: 10px;
}

.cansel-btn{
    background: #25ed93;
    color:white;
    border: none;
    padding: 4px 7px;
    border-radius: 10px;

}
</style>