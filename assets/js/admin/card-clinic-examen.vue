<style lang="scss">

</style>

<template>
  <div class="card draggable">
    <div class="card-header" v-if="!isEditing" @dblclick="editExamen">
      {{currentExamen.type.name}}
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
            @onInput="onInputEventHandler"
        >
        </vue3-simple-typeahead>
        <button class="btn btn-success btn-sm" @click="validate">Valider</button>
        <button class="btn btn-danger btn-sm" @click="cancel">Annuler</button>
      </div>

    </div>
    <div class="card-body">
      <span class="badge badge-primary" v-for="value in currentExamen.availableValues">{{value.name}}</span>
    </div>
    <div>
    </div>
  </div>
</template>
<script>

import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css';
import axios from "axios";
import { isProxy, toRaw } from 'vue';

export default {
  name: "card-clinic-examen",
  components: {
    SimpleTypeahead
  },
  props: {
    examen: {
      required: true,
      type: Object
    },
    position: {
      required: true,
      type: Number
    }
  },
  data() {
    return {
      currentExamen : this.examen,
      isEditing: false,
      newExamen: {},
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
      this.newExamen = toRaw(item)
      this.newExamen.position = this.position;
    },
    validate() {
      this.currentExamen = toRaw(this.newExamen)
      this.isEditing = false;
      this.$emit('examenCreated', this.currentExamen)
    },
    cancel() {
      this.isEditing = false;
    }
  },
};
</script>
