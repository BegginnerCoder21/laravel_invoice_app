<template>
    <div class="min-h-screen flex-col flex justify-center bg-gray-100 items-center">

        <div class=" border-[1px]  w-[52%] h-[600px] border-blue-400 rounded-md bg-white overflow-y-auto">
            <div class="px-6 py-4 flex flex-col">
                <h2 class="text-lg text-gray-700 mb-3">Creation d'une nouvelle facture</h2>
                <div class="space-y-4">
                    <h3 class="font-semibold">Détails</h3>
                        <select name="name" id="name" class="rounded-md border-[1px] p-2 border-blue-400 outline-none" v-model="customer_id">
                            <option value="name" disabled>
                                Choisir le client
                            </option>
                            <option  v-for="customer in all_customers" :key="customer.id" :value="customer.id">
                                {{ customer.firstname }} {{ customer.lastname }}
                            </option>
                        </select>
                        <form action="#" class="space-y-12">
                            <div class="flex flex-row">
                                <div class="pr-28">
                                    <label for="date">Date</label>
                                    <input type="date" class="outline-none border-[1px]  rounded-md py-2 w-[238px] px-2 border-blue-400" v-model="form.date" >
                                </div>
                                <div>
                                    <label for="due_date">Date d'echeance</label>
                                    <input type="date" placeholder="Date d'écheance de la facture" class="outline-none border-[1px] rounded-md py-2 px-2 w-[238px] border-blue-400" v-model="form.due_date">
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="pr-28 flex flex-col">
                                    <label for="reference">Reference</label>
                                    <input type="reference" placeholder="Réference de la facture" class="outline-none border-[1px] rounded-md py-2 px-2 w-[238px] border-blue-400" v-model="form.reference">
                                </div>
                                <div class="flex flex-col">
                                    <label for="numero">Numero</label>
                                    <input placeholder="Numero de la facture" type="numero" class="outline-none border-[1px] rounded-md py-2 px-2 w-[238px] border-blue-400" v-model="form.number">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="">
                <div class="bg-gray-300 mt-2 text-sm px-6 font-semibold py-1 w-full flex">
                    <h4 class="flex flex-1">
                        Description facture
                    </h4>
                    <div class="flex flex-row space-x-14 pr-10">
                        <h4>
                            Prix unitaire
                        </h4>
                        <h4>
                            Quantité
                        </h4>
                        <h4>
                            Total
                        </h4>
                    </div>

                </div>
                <div class="overflow-y-auto">
                    <div >
                        <div class="flex flex-col space-x-3" v-for="(item,i) in listCart" :key="item.id">
                            <section class="border-b-[1px] flex p-2 border-b-gray-300">
                                <div class="flex space-x-8 ml-4  mr-44">
                                    <span>
                                        #{{ item.item_code }}
                                    </span>
                                    <span>
                                       Nom produit
                                    </span>
                                </div>
                                <div class="flex flex-row space-x-3">
                                    <input type="text" class="outline-none rounded-md px-2 w-[100px] py-[4px] border-[1px] border-gray-300" v-model="item.unit_price">
                                    <input type="text" class="outline-none rounded-md px-2 w-[100px] py-[4px] border-[1px] border-gray-300" v-model="item.quantity">
                                    <span v-if="item.quantity">{{ item.unit_price * item.quantity }} fcfa</span>
                                    <span v-else></span>
                                    <div class="text-red-500 cursor-pointer" @click="deleteLine(i)">
                                    <span>X</span>
                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                    <button type="button" class="bg-blue-400 py-2 px-4 rounded-md my-2 mx-6 text-white" @click="openModal()">Ajouter une ligne</button>
                    <div class="flex flex-row px-6">
                        <div class="flex flex-col flex-1 mr-6">
                            <label for="terms">Terms et conditions</label>
                            <textarea name="terms" id="" cols="10" rows="3" class="outline-none pt-2 border-[1px]" v-model="form.term_and_condition">

                            </textarea>
                        </div>
                        <div class="flex flex-col mr-28 space-y-1 mt-4 ">
                            <div class="flex flex-row space-x-36">
                                <h3>Sub total</h3>
                                <p>{{ subTotal() }} fcfa</p>
                            </div>
                            <div class="flex flex-row space-x-32 items-center">
                                <h3>Reduction</h3>
                                <input type="text" class="border-[1px] outline-none px-1 border-gray-300 py-1 rounded-md w-[100px]" v-model="form.discount">
                            </div>
                            <div class="flex flex-row space-x-44">
                                <h3>Total</h3>
                                <p>{{ Total() }} fcfa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add modal items -->
        <div class="modal main__modal " :class="{show : showModal}">
            <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="openModal()">×</span>
            <h3 class="modal__title">Add Item</h3>
            <hr><br>
            <div class="modal__items">
               <ul class="product-container" >
                    <li class="product-content" v-for="(product,i) in listProduct" :key="product.id">
                        <p>#{{ i+1 }}</p>
                        <p>{{ product.code_item }}</p>
                        <button @click="addCart(product)">+</button>
                    </li>
               </ul>
            </div>
            <br><hr>
            <div class="model__footer">
                <button class="btn btn-light mr-2 btn__close--modal" @click="openModal()">
                    Annuler
                </button>
                <button class="btn btn-light btn__close--modal ">Ok</button>
            </div>
            </div>
        </div>
        <div class="ml-[40%]">
            <button type="button" class="bg-blue-400 py-2 px-4 rounded-md my-2 mx-6 text-white" @click="onSave()">Enregistrer</button>
        </div>
    </div>
</template>

<script setup lang="ts">

import axios from "axios";
import type typeCart from '../../types/typeCart';
import { onMounted, ref} from "vue";
import { useRouter } from "vue-router";
const all_customers = ref();
const form = ref([]);
const customer_id = ref([]);
const showModal = ref(false);
const listCart = ref<typeCart[]>([]);
const listProduct = ref();
const router = useRouter();

const deleteLine = (product) => {
    listCart.value.splice(product,1)
}

const newInvoice = async () =>  {
    let response = await axios.get('/api/new-invoice');
    form.value = response.data;

}

const allCustomers = async () => {
    let response = await axios.get('/api/all-customers');
    all_customers.value = response.data.customers;
}

const openModal = () => {
    showModal.value = !showModal.value;
}

const addCart = (product) => {

    const productCart = {
        id : product.id,
        item_code : product.code_item,
        description : product.description,
        unit_price : product.unit_price,
        quantity : product.quantity ?? 1
    };

    listCart.value.push(productCart);
}

const getAllProducts = async () => {
    let response = await axios.get('api/all-products');
    listProduct.value = response.data.products;
}

const subTotal = () => {
    let total = 0;

    listCart.value.map((data) => {
        total += data.quantity * data.unit_price;
    });

    return total;
}

const Total = () => {

    return subTotal() - form.value.discount;
}

const onSave = async() => {

    if(!customer_id || !form.value.reference || !form.value.date || !form.value.due_date || !form.value.number){
        return console.log({
            'reference' : form.value.reference,
            'date' : form.value.date,
            'due_date' : form.value.due_date,
            'number' : form.value.number,
            'customer_id' : customer_id.value
        });

        
        
    }
    let sub_total = subTotal();
    let total = Total();

    const formData = new FormData();
    
    formData.append('invoice_item',JSON.stringify(listCart.value));
    formData.append('customer_id',customer_id.value);
    formData.append('reference',form.value.reference);
    formData.append('date',form.value.date);
    formData.append('due_date',form.value.due_date);
    formData.append('number',form.value.number);
    formData.append('discount',form.value.discount);
    formData.append('subtotal',sub_total);
    formData.append('total',total);
    formData.append('term_and_condition',form.value.term_and_condition);
    
    
    let response = await axios.post('api/add-invoice',formData).catch((err) => console.log(err));
    listCart.value = [];
    router.push('/');
}
onMounted(async() => {
    await newInvoice();
    await allCustomers();
    await getAllProducts();
})

</script>

<style scoped>

.product-content{
     display: grid;
     grid-template-columns: 30px 350px 15px;
     align-items: center;
     padding-bottom: 5px;
}

.product-content button{
    padding: 5px;
    border: 1px solid #e0e0e0;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.product-container{
    list-style: none;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 20%;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    color: #454f5b;
}

.show {
    display: block !important;
}

.modal__content {
    background-color: white;
    margin: auto;
    padding: 20px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 2px 15px rgb(35 40 47 / 25%);
    position: relative;
    border: none;
    border-radius: 7px;
}

.modal__close {
    color: #aaaaaa;
    font-size: 28px;
    font-weight: bold;
    top: 5px;
    right: 15px;
    position: absolute;
    cursor: pointer;
}

.modal__title {
    margin-bottom: 20px;
}

.modal__items {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.inputAdd {
    padding: 9px 15px;
    border-top: 1px solid #e0e0e0;
    border-left: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    border-right: none;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    width: 100%;
}

.inputAdd__Btn {
    background: #5463c1;
    color: white;
    border-top: 1px solid #5463c1;
    border-right: 1px solid #5463c1;
    border-bottom: 1px solid #5463c1;
    border-left: none;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    padding: 9px 15px;
    cursor: pointer;
}

.model__footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 20px;

}

.btn {
    border: 1px solid #6a727a;
    padding: 9px 15px;
    border-radius: 4px;
    cursor: pointer;
}
.btn-light {
    border: 1px solid #808891;
    background: white;
    color: #454f5b;
}
.mr-2 {
    margin-right: 20px;
}


</style>
