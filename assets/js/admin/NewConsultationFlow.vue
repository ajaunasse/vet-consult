<template>
  <div class="row justify-content-center">
    <div class="6">
      <select class='form-control' v-model="consultationMotif">
        <option disabled value="">Séléction un motif de consultatuion</option>
        <option>Atteinte vestibulaire (tête penchée)</option>
        <option>Tremblements et/ou incoordination des mouvements</option>
      </select>
    </div>
  </div>
  <hr>
  <div class="row justify-content-center">

    <div class="col-6 ">
      <h3>Examens clinique     <button class="btn btn-success button float-end" @click="addExemen"> <span class="fa fa-plus"></span> Ajouter un examen clinique</button>
      </h3>

      <nested :listExamen="listExamen" />
    </div>
  </div>


</template>

<script>
import nested from './nested.vue'

export default {
  components: {
    nested,
  },
  data() {
    return {
      listConsultation: {

      },
      consultationMotif: '',
      listExamen: [
      ],
    }
  },
  methods: {
     addExemen() {
      this.listExamen.push({
        'type': 'Nouveau',
        'availableValues': [],
        'position' : this.listExamen.length + 1,
        'subExamem': []
      });
    }
  }
}
</script>
<style scoped></style>