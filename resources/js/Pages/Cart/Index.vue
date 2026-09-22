<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,router } from '@inertiajs/vue3';

defineProps({
    items:Array
})


const removeItem = (id)=>{
    router.post(route('cart.remove',id))

}

const decreaseItem =(id)=>{
    router.post(route('cart.decrease',id))
}

const addItem = (id)=>{
    router.post(route('cart.add',id))
}

const clearCart = ()=>{
    router.post(route('cart.clear'))
}

</script>

<template>
        <Head title="Ювелирные изделия" />
                <AuthenticatedLayout>
                        <div>Корзина</div>

                        <div class="cart-page">
                            <button class="clear-button" @click="clearCart()">
                                Очистить корзину
                            </button>
                            <div class="cart-info" v-for="item in items" :key="item.id">
                                <h3>{{item.title}}</h3>
                                <h2>{{item.price}}</h2>
                                <h2>{{item.quantity}}</h2>
                                    <div class="cart-actions">
                                        <button @click="decreaseItem(item.id)">-</button>
                                        <button @click="addItem(item.id)">+</button>
                                        <button @click="removeItem(item.id)">Удалить</button>
                                    </div>
                            </div>

                          
                        </div>

                </AuthenticatedLayout>
</template>


<style scoped>
.cart-actions{
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.cart-info{
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 10px;
    background: white;
}

.cart-actions button{
    background: #6c96f2;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
}

.clear-button{
    background: #f44c4c;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
}

</style>