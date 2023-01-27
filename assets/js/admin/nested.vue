<style lang="scss">
* {
  background-color: red;
}
  .examen-item {
    margin-top: 2px;
  }
  .nested-element {
    margin-left: 50px
  }

</style>

<template>
  <draggable
      :list="listExamen"
      class="dragArea"
      :animation="200"
      group="examen"
      ghostClass="sortable-ghost"
      chosenClass="sortable-chosen"
      dragClass="sortable-drag"
      item-key="id">
    <template #item="{element}">
      <div class="examen-item">
        <card-clinic-examen :examen="element"></card-clinic-examen>
        <div class="nested-element" >
          <nested-draggable :listExamen="element.subExamems" />
        </div>
      </div>
    </template>
  </draggable>
</template>
<script>

import draggable from "vuedraggable";
import CardClinicExamen from "./card-clinic-examen.vue";

export default {
  props: {
    listExamen: {
      required: true,
      type: Array
    }
  },
  components: {
    CardClinicExamen,
    draggable
  },
  name: "nested-draggable"
};
</script>
