<style lang="scss">
</style>

<template>
  <button class="btn btn-success" @click="openModal">Ajouter un nouveau</button>

  <div id="new-motif-consultation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="new-motif-consultation" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="motif">Libellé du motif de consultation</label>
              <input type="input" class="form-control" id="motif-consultation" aria-describedby="emailHelp" placeholder="Enter nom">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" @click="save()">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="new-motif-consultation">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Routing from 'fos-router';
import axios  from "axios";
export default {
  props: {
  },
  data() {
    return {
      value: ''
    }
  },
  methods: {
    save() {
      let route_add = Routing.generate('api_consultation_flow_post');
      axios.post(route_add, {
        value: this.value,
      })
      .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    openModal() {
      $("#new-motif-consultation").modal("show");
    }
  },
  name: "modal-new-motif-consultation"
};
</script>
