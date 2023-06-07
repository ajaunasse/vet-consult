<style lang="scss">
</style>

<template>
  <div id="modal-new-step" class="modal" tabindex="-1" role="dialog" @keydown.esc="closeModal()">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nouvelle étape</h5>
          <button type="button" class="close" data-dismiss="modal-new-step" aria-label="Close" @click="closeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="motif">Etape précedente</label>
              <input v-model="this.previousStep.name" class="form-control" id="previous-step" disabled>
            </div>
            <div class="form-group">
              <label for="motif">Position</label>
              <input   v-model="this.step.position" class="form-control" id="position" disabled>
            </div>
            <div class="form-group">
              <label for="motif">Nom de l'étape</label>
              <input v-model="this.step.name" name="name" class="form-control" id="name"  placeholder="Enter nom">
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group col-md-6">
                        <label for="motif">Examen déclencheur (en fonction de l'étape précedente)</label>
                        <select v-model="this.step.triggerExamen" class="form-control">
                            <option disabled value="">Please select one</option>

                            <option v-for="item in this.previousStep.examens" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>

                </div>
                <div class="col">
                    <div class="form-group col-md-6">
                        <label for="motif">Symptome déclencheur (en fonction de l'étape précedente)</label>
                        <select v-model="this.step.triggerValue" class="form-control">
                            <option disabled value="">Please select one</option>

                            <option v-for="item in this.availableTriggersValues" :value="item">{{ item }}</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="form-group">
              <label for="motif">Examens cliniques</label>
              <button type="button" class="button btn-success btn-xs" @click="addExamen()"> Ajouter un examen</button>
              <div v-for="n in this.nbExamens">
                <vue3-simple-typeahead
                    :id="getTypeaheadRef(n)"
                    :ref="getTypeaheadRef(n)"
                    placeholder="Rechercher un examen clinique.."
                    class="form-control"
                    :v-model="this.step.examens"
                    :items="this.availableExamens"
                    :minInputLength="0"
                    :itemProjection="
                      (item) => {
                        return item.fullValue;
                      }
                    "
                    @selectItem="selectItem"
                >
                </vue3-simple-typeahead>
                <span @click="removeItem(n)" class="fa fa-trash"></span>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" @click="save()">Save changes</button>
          <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Routing from 'fos-router';
import axios  from "axios";
import {toRaw} from "vue";
export default {
  props: {
    consultationFlowId: {
      required: true,
    },
  },
  data() {
    return {
      step: {
        name: "",
        previousStepKey: null,
        examens: [],
        position: 0,
        triggerValue: "",
        triggerExamen : "",
        previousStepId: 0,
      },
      previousStep: {
        "name": null,
        "position": null,
      },
      availableExamens: [],
      value: '',
      availableTriggersValues: [],
      nbExamens: 1,
      edit: false
    }
  },
  mounted() {
    axios.get(Routing.generate('api_clinic_examen_get'))
        .then(response => {
          this.availableExamens = response.data
      })


  },
  methods: {
    getExamenClinics() {
      console.log('toot');
        axios.get(Routing.generate('api_clinic_examen_get'))
            .then(response => {
              this.availableExamens = response.data
            })

      return this.availableExamens;
    },
    editModal(currentStep) {
      if(!currentStep) return
      this.step = currentStep
      if(this.step.previousStep !== null) {
        this.previousStep = this.step.previousStep
        let temp2 = [];
        currentStep.previousStep.examens.forEach(function (e) {
          e.availableValues.forEach((i) => temp2.push(i))
        })

        this.availableTriggersValues = [...new Set(temp2)];
      }

      this.edit = true
      const ref = this.$refs
      this.step.examens.forEach(function (e, index){
        console.log(ref["typeahead_"+(index+1)])
        console.log(ref["typeahead_1"])
        console.log(ref)
        self.$refs[type].inputValue = e.name;
        console.log('e', e)
      })
      $("#modal-new-step").modal("show");

    },
    openModal(previousStep) {
      if(!previousStep) return
      this.previousStep = previousStep;
      this.step.position = (parseInt(this.previousStep.position) + 1)
      let temp2 = [];
      this.step.previousStepId = parseInt(previousStep.key);
      previousStep.examens.forEach(function (e) {
        e.availableValues.forEach((i) => temp2.push(i))
      })

      this.availableTriggersValues = [...new Set(temp2)];

      $("#modal-new-step").modal("show");
    },
    closeModal() {
      this.previousStep = null;
      this.step = {
        name: "",
        examens: [],
        position: 0,
        triggerValue: ""
      };
      $("#modal-new-step").modal("hide");
      this.$emit('reload')

    },
    addExamen() {
      this.nbExamens++;
    },
    removeItem(n) {
      this.step.examens.splice(n, 1)
      this.nbExamens--;
    },
    selectItem(item) {
      this.step.examens.push(item)
    },
    save() {
      let route_add = Routing.generate('api_consultation_flow_add_step', {'id': this.consultationFlowId});
      axios.post(route_add, this.step)
          .then(function (response) {
          })
          .catch(function (error) {
            console.log(error);
        });
      this.$emit('reload')
      $("#modal-new-step").modal("hide");
    },
    getTypeaheadRef(n) {
      return 'typehead_' + n;
    }
  },
  name: "modal-new-step"
};
</script>
