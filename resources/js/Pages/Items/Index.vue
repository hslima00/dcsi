<template>

  <DashboardLayout>
    <Alert
        v-if="dueCalibrationItems.length > 0"
        :dueItems="dueCalibrationItems"
    />

    <TableWithImages :items="items" :systems="systems"/>

  </DashboardLayout>


</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import TableWithImages from "@/Components/TableWithImages.vue";
import Alert from "@/Components/Alert.vue";

import {defineProps, computed} from "vue";
import Search_component from "@/Components/Search_component.vue";

const props = defineProps({
  items: Array,
  dueCalibrationItems: Array,
  systems: Array,

});


</script>
