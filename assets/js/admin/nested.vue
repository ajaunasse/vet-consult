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
      :list="examens"
      class="dragArea"
      :animation="200"
      group="examen"
      ghostClass="sortable-ghost"
      chosenClass="sortable-chosen"
      dragClass="sortable-drag"
      item-key="id">
    <template #item="{element}">
      <div class="card examen-item">
        <card-clinic-examen @examen-created="examenCreatedListener" :examen="element.clinicExamen" :position="element.position"></card-clinic-examen>
        <div class="nested-element" >
          <nested-draggable :examens="element.subExamems" />
        </div>
      </div>
    </template>
  </draggable>
</template>
<script>

import draggable from "vuedraggable";
import CardClinicExamen from "./card-clinic-examen.vue";
import { isProxy, toRaw } from 'vue';

export default {
  props: {
    examens: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
      listExamen: []
    }
  },
  components: {
    CardClinicExamen,
    draggable
  },
  methods: {
    examenCreatedListener(examen) {
      console.log('event', examen)
      this.listExamen.push(toRaw(examen))
      this.listExamen.sort((a,b) => a.position - b.position);
      this.$emit('examenListUpdated', this.listExamen)

    }
  },
  name: "nested-draggable"
};
</script>
