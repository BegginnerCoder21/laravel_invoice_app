<template>
    <!--==================== SHOW INVOICE ====================-->
    <div class="container">
    <div class="invoices">
        
        <div class="card__header">
            <div>
                <h2 class="invoice__title">Facture</h2>
            </div>
            <div>
                
            </div>
        </div>
        <div>
            <div class="card__header--title ">
                <h1 class="mr-2">#{{ form.id }}</h1>
                <p>{{ form.created_at }} </p>
            </div>
    
            <div>
                <ul  class="card__header-list">
                    <li>
                        <!-- Select Btn Option -->
                        <button class="selectBtnFlat">
                            <i class="fas fa-print"></i>
                            Imprimer
                        </button>
                        <!-- End Select Btn Option -->
                    </li>
                    <li>
                        <!-- Select Btn Option -->
                        <button class="selectBtnFlat">
                            <i class=" fas fa-reply"></i>
                            Editer
                        </button>
                        <!-- End Select Btn Option -->
                    </li>
                    <li>
                        <!-- Select Btn Option -->
                        <button class="selectBtnFlat ">
                            <i class=" fas fa-pencil-alt"></i>
                            Supprimer
                        </button>
                        <!-- End Select Btn Option -->
                    </li>
                    
                </ul>
            </div>
        </div>

        <div class="table invoice">
            <div class="logo">
                <img src="assets/img/logo.png" alt="" style="width: 200px;">
            </div>
            <div class="invoice__header--title">
                <p></p>
                <p class="invoice__header--title-1">Facture</p>
                <p></p>
            </div>

            
            <div class="invoice__header--item">
                <div>
                    <h2>Facture De:</h2>
                    <p v-if="form.customer">{{ form.customer.firstname }} {{ form.customer.lastname }}</p>
                    <p v-else></p>
                </div>
                <div>
                        <div class="invoice__header--item1">
                            <p>Facture#</p>
                            <span>#{{ form.number }}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Date</p>
                            <span>{{ form.date }}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Date d'echeance</p>
                            <span>{{ form.due_date }}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Reference</p>
                            <span>{{ form.reference }}</span>
                        </div>
                    
                </div>
            </div>

            <div class="table py1">

                <div class="table--heading3">
                    <p>#</p>
                    <p>Description</p>
                    <p>Prix unitaire</p>
                    <p>Qty</p>
                    <p>Total</p>
                </div>
    
                <!-- item 1 -->
                <div class="table--items3" v-for="(item,i) in form.products">
                    <p>{{ i + 1 }}</p>
                    <p>{{ item.code_item }}</p>
                    <p>{{ item.pivot.unit_price }}</p>
                    <p>{{ item.pivot.quantity }}</p>
                    <p>{{ item.pivot.quantity * item.pivot.unit_price }}</p>
                </div>
            </div>

            <div  class="invoice__subtotal">
                <div>
                    <h2>Merci pour votre fidelité</h2>   
                </div>
                <div>
                    <div class="invoice__subtotal--item1">
                        <p>Sub Total</p>
                        <span> {{ form.sub_total }} fcfa</span>
                    </div>
                    <div class="invoice__subtotal--item2">
                        <p>Reduction</p>
                        <span>{{ form.discount }} fcfa</span>
                    </div>
                    
                </div>
            </div>

            <div class="invoice__total">
                <div>
                    <h2>Termes et conditions</h2>
                    <p>{{ form.term_and_condition }} </p>
                </div>
                <div>
                    <div class="grand__total" >
                        <div class="grand__total--items">
                            <p>Prix Total</p>
                            <span>{{ form.total }} fcfa</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card__footer">
            <div>
                
            </div>
            <div @click="print()">
                <a class="btn btn-secondary">
                    Enregistrer
                </a>
            </div>
        </div>
        
    </div>

    <br><br><br>
    </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
const route = useRouter()
const form = ref([]);


const props = defineProps({
    id : {
        type : String,
        default : ''
    }
});

const getInvoice = async () => {
    let response = await axios.get(`/api/show-invoice/${props.id}`);
    form.value = response.data.invoice;
    console.log(form.value);
}

const print = () => {
    window.print();
    route.push('/').catch(() => {});
}

onMounted(async() => {
    await getInvoice();
})
</script>

<style scoped>
.container{
    max-width: 78%;
    margin: auto;
}

.selectBtnFlat {
    border: none;
    padding: 9px 15px;
    border-radius: 4px;
    cursor: pointer;
    position: relative;
    color: #0ea5e9;
    background: none;
}

.card__header--title {
    display: flex;
    justify-content: flex-start;
}

.card__header--title h1 {
    padding-right: 5px;
}

.card__header-list {
    display: flex;
    justify-content: flex-start;
    list-style: none;
    margin-top: 10px;
    margin-bottom: 10px;
    
}

.invoice {
    background:white ; 
    color:black
}

.btn-secondary{
    background-color: #0ea5e9;
    color: white;
    padding: 7px 15px 7px 15px;
    border-radius: 5px;
    cursor: pointer;
}

.logo {
    padding-top:40px;
    padding-left:25px;
    height: 60px;
    padding-bottom: 15px;
}

.invoice__header--title {
    background-color: #e0e0e0; 
    display: grid; 
    grid-template-columns: 65% 1fr 1fr;
    margin-top: 80px;
}

.invoice__header--title-1 {
    font: bold 100% sans-serif;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    background-color: white;
    text-align: center;
    font-size: 36px;
    padding-left: 45px;
    padding-right: 45px;
}

.invoice__header--item {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 200px;
    padding: 40px;
}

.invoice__header--item1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    margin-top: 30px;
}

.invoice__header--item1 p {
    font-size: 20px;
}

.invoice__header--item1 span {
    font-size: 20px;
}

.invoice__header--item2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.invoice__header--item2 p {
    font-size: 20px;
}

.invoice__header--item2 span {
    font-size: 20px;
}

.table--heading3 {
    display: grid;
    grid-template-columns: 25px 500px 1fr 1fr 1fr ;
    grid-gap: 10px;
    padding: 10px 30px !important;
    font-weight: 900;
    background-color:#64748b; 
    color:white;
    font-size: 20px;
}

.py1 {
    padding-left: 40px;
    padding-right: 40px;
}

.table--items3 {
    display: grid;
    grid-template-columns: 25px 500px 1fr 1fr 1fr ;
    grid-gap: 10px;
    align-items: center;
    border-bottom: 1px solid #e0e0e0;
    padding: 10px 30px !important;
    font-size: 16px;
    color: black;
}

.table--items--transactionId3 {
    color: black;
    font-weight: 500;
}

.invoice__subtotal {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 200px;
    padding-top: 10px;
    padding-left: 40px;
    padding-right: 40px;
}

.invoice__subtotal--item1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    margin-bottom: 20px;
}

.invoice__subtotal--item1 p {
    font-size: 20px;
    padding-left: 55px;
}

.invoice__subtotal--item1 span {
    font-size: 20px;
}

.invoice__subtotal--item2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.invoice__subtotal--item2 p {
    font-size: 20px;
    padding-left: 55px;
}

.invoice__subtotal--item2 span {
    font-size: 20px;
}

.invoice__total {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 150px;
    padding: 25px;
}

.grand__total {
    margin-top: 50px;
    background-color: #0ea5e9;
    color: black;
}

.grand__total--items {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    margin-top: 15px;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 0.5in;
    padding-right: 0.5in;font-size: 26px;
}

.grand__total--items p {
    font-size: 26px;
}

.grand__total--items span {
    font-size: 26px;
}

</style>