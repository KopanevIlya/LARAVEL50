<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link} from '@inertiajs/vue3';

defineProps({
    messages:Array
})


const addToCart = (id)=>{
    router.post(route('cart.add',id))
}

</script>

<template>
        <Head title="Ювелирные изделия" />
                <AuthenticatedLayout>



                    <div class="properties-page">

                      





                       
                        <div v-for="msg in messages" :key="msg.id" class="properties-grid">
                            <div class="property-card">
                                <h2>{{ msg.user.name }}</h2>
                                <h3>{{msg.message}}</h3>
                               
                                
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