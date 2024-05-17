<script setup>
import { router } from '@inertiajs/vue3';
import Person from '@/Components/Person.vue';
import { onMounted, ref, onUpdated,watchEffect } from 'vue';


const props = defineProps({
    order:{
        type:Object,
        required:true
    },
});

const owner = ref({});
const users = ref({});
const emit  = defineEmits(['close']);

const loadData = ()=>{
    users.value = {...props.order.users};
    owner.value = {...props.order.users[localStorage.getItem('token')]};
    delete users.value[localStorage.getItem('token')]
}

onMounted(()=>{
    console.log(props.order);
    loadData();
});

watchEffect(() => {
    loadData();
});

</script>


<template>
      <div class="order">
          <div>
              <div class="yours">
                <div v-if="owner.orders">
                    <Person :person="owner" :edit="true"/>
                </div>
                <div v-else>
                    <h3>No has agregado nigún platillo</h3>
                </div>

              </div>
              <div class="others">
                    <div v-if="Object.keys(order.users).length">
                        <div v-for="user in users">
                            <Person :person="user"/>
                        </div>
                    </div>
                    <div v-else>
                        <h2>Solo tú estás ordenando en esta comanda</h2>
                    </div>
                  
              </div>
          </div>
          <footer>
            <div>Gran Total: <span class="money">{{ order.total }}</span></div>
            <div>Comensales: {{ order.users ? Object.keys(order.users).length :  0 }}</div>
            <div>
                <button class="btn" @click="emit('close')">Cancelar</button>
            </div>
          </footer>
      </div>
</template>
