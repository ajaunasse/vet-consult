<style lang="scss">

</style>

<template>
  <div class="card draggable">
    <div class="card-header" v-if="!isEditing" @dblclick="editExamen">
      {{examen.type}}
      <span class="fa fa-trash float-end"></span>
    </div>
    <div v-else>
      <div class="card-header">
        <vue3-simple-typeahead
            id="typeahead_id"
            placeholder="Rechercher un examen clinique.."
            class="form-control"
            :items="getExamenClinics()"
            :minInputLength="0"
            :itemProjection="
						(item) => {
							return item.fullValue;
						}
					"
            @selectItem="selectItem"
        >
        </vue3-simple-typeahead>
        <button class="btn btn-success btn-sm" @click="validate">Valider</button>
        <button class="btn btn-danger btn-sm" @click="cancel">Annuler</button>
      </div>

    </div>
    <div class="card-body">
      <span class="badge badge-primary">{{examen.availableValues}}</span>
    </div>
  </div>
</template>
<script>

import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css';
import Routing from 'fos-router';
import axios from "axios";
export default {
  name: "card-clinic-examen",
  components: {
    SimpleTypeahead
  },
  props: {
    examen: {
      required: true,
      type: Object
    }
  },
  data() {
    return {
      isEditing: false,
      newExamen: null,
      availableExamens: []
    }
  },
  methods: {
    editExamen() {
      this.isEditing = !this.isEditing
    },
    getExamenClinics() {
      if(this.availableExamens.length === 0) {
        axios.get(Routing.generate('api_clinic_examen_get'))
          .then(response => {
            this.availableExamens = response.data
          })
      }

      return this.availableExamens;
    },
    selectItem(item) {
      console.log(item.id)
      console.log({...this.availableExamens.find(examen => examen.id === item.id)})
      this.newExamen = {...this.availableExamens.find(examen => examen.id === item.id)}
    },
    validate() {
      this.examen = this.newExamen;
      this.isEditing = false;
    },
    cancel() {
      this.isEditing = false;
    }
  },
};
</script>
