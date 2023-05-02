<template>
  <div class="row justify-content-center">

    <div class="col-6">
      <select class='form-control' v-model="currentFlow.reason" @change="save()">
        <option disabled value="">Séléction un motif de consultation</option>
        <option v-for="consultation_reason in this.listConsultation" :value="consultation_reason">{{consultation_reason.value}}</option>
      </select>
    </div>
    <div class="col-3">
      <modal-new-motif-consultation></modal-new-motif-consultation>

    </div>
  </div>
  <hr>
  <div class="row justify-content-center">

    <div class="col-6 ">
      <h3>Examens clinique   <button class="btn btn-success button float-end" @click="addExemen"> <span class="fa fa-plus"></span> Ajouter un examen clinique</button>
      </h3>

      <nested @examen-list-updated="examenListUpdatedListener" :examens="currentFlow.examens" />
    </div>
  </div>


</template>

<script>
import nested from './nested.vue'
import modalNewMotifConsultation from "./modal-new-motif-consultation.vue";
import axios from "axios";
import { isProxy, toRaw } from 'vue';
import Routing from 'fos-router';

export default {
  components: {
    nested,
    modalNewMotifConsultation
  },
  data() {
    return {
      listConsultation: {
      },
      currentFlow: {
        id: null,
        reason: {},
        examens: []
      }
    }
  },
  beforeCreate() {
    axios.get(Routing.generate('api_consultation_reason_get'))
        .then(response => {
          this.listConsultation = response.data
        })

    if(typeof entityId !== 'undefined') {
      axios.get(Routing.generate('api_consultation_flow_get' , {'id': entityId}))
          .then(response => {
            this.currentFlow = response.data
          })
    }
  },
  methods: {
     addExemen() {
      this.currentFlow.examens.push({
        'clinicExamen': {
          'type': {
            'name': 'Nouveau'
          },
          'availableValues': [],
        },
        'position' : this.currentFlow.examens.length + 1,
        'subExamems': []
      });
    },
    save() {
      axios.post(Routing.generate('api_consultation_flow_save'),  this.currentFlow )
          .then(response => {
            this.currentFlow = response.data
          })
    },
    examenListUpdatedListener(elements) {
       this.currentFlow.examens = toRaw(elements);
       this.save()
    },

  }
}
</script>
<style scoped></style>