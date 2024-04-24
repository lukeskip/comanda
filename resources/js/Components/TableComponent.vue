
<template>
    
    <div>

      <div class="flex justify-between space-x-4">
        
        <div>
          <template v-if="items.links" class="mb-7">
            <Pagination :pagination="items.links"/>
          </template>
        </div>

        <div>
          <form  @submit.prevent="submitSearch(root)">
            <div class="flex mb-2 gap-1">
              <TextInput v-model="searchTerm" :name="'search'" />
              <PrimaryButton>
                Buscar
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>

      <table v-if="items.data.length" class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="sticky top-24 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr >
                  <template v-for="(value, key) in  items.data[0]" :key="key">
                    <th v-if="key !== 'id'"  class="px-6 py-3">
                      {{ showLabel(key) }}
                    </th>
                  </template>
                  <template v-if="actions.length">
                      <th>Acciones</th>
                  </template>
              </tr>
          </thead>
          <tbody>
              <tr v-for="item in items.data" :key="item.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <template v-for="(value, key, index) in item" :key="key">
                    <td v-if="key !== 'id'" class="border px-4 py-2">
                      <template v-if="index=== 1 && root !== '' && !inner">
                        <Link :href="route(`${root}.show`,item.id)">{{ value }}</Link>
                      </template>
                      <template v-else-if="key !== 'id'"><span v-html="showLabel(value)"></span></template>
                    </td>
                  </template>
                  <td class="border px-4 py-2 text-center" v-if="actions.length">

                    <ActionButton v-for="(action,index) in actions" :key="index + action" :root="root" :action="action" :id="item.id" :parentId="[parentId,item[parentId]]"/>
                    
                  </td>
              </tr>
          </tbody>
      </table>
      <div v-else>
        <p class="text-xl">No hay información que mostrar</p>
      </div>
      
    </div>

    
</template>

<script setup>
import { ref } from 'vue';
import showLabel from '@/helpers/showLabel.js';
import { Link,router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue'
import ActionButton from '@/Components/ActionButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';




const props = defineProps({
    items: {
      type: [Array,Object],
      required: true,
    },
    root: {
      type: String,
      default:""
    },
    actions: {
      type: Array,
      default: []
    },
    parentId:{
      type:String
    },
    inner:{
      type:Boolean,
      default:false,
    },
    searchField:{
      type:String,
      default:"name"
    }
});


const searchTerm = ref('');

const submitSearch = (root) => {
  router.get(root, { search: searchTerm.value })
};


</script>@/helpers/showLabel.js