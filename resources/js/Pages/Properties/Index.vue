<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link} from '@inertiajs/vue3';

defineProps({
    properties:Array
})


const addToCart = (id)=>{
    router.post(route('cart.add',id))
}

</script>

<template>
        <Head title="Ювелирные изделия" />
                <AuthenticatedLayout>



                    <div class="properties-page">

                        <div>
                            <Link :href="route('cart.index')">Перейти в корзину</Link>
                            
                         </div>





                       
                        <div v-for="property in properties" :key="property.id" class="properties-grid">
                            <div class="property-card">
                                <h3>{{property.title}}</h3>
                                <h3>{{property.price}}</h3>
                                <h3>{{property.adress}}</h3>
                                <button class="property-button" @click="addToCart(property.id)">Добавить в корзину</button>
                            </div>
                        </div>
                    </div>
                </AuthenticatedLayout>
</template>


<style scoped>
.properties-page{
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
}

.properties-grid{
display: grid;
grid-template-columns: repeat(3,1fr);
gap: 25px;
}

.property-card{
    background: #ffffff;
    border: 1px solid #e9e9ec;
    border-radius: 15px;
    overflow: hidden;
    transition: 0.2s ease;
}

.property-card:hover{
    transform: translateY(-4px);
    box-shadow: 21px -3px 54px 1px rgba(34, 60, 80, 0.3);
}

.property-button{

    background: #111827;
    color: white;
}



</style>