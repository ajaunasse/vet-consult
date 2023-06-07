<template>
  <div class="loading" v-if="loading">Loading&#8230;</div>

  <div class="row">

    <div class="col-6">
      <select class='form-control' v-model="consultationFlow.reason" @change="save()">
        <option disabled value="">Séléction un motif de consultation</option>
        <option v-for="consultation_reason in this.listConsultation" :value="consultation_reason">{{consultation_reason.value}}</option>
      </select>
    </div>
    <div class="col-3">
      <modal-new-motif-consultation></modal-new-motif-consultation>
    </div>
  </div>

    <modal-new-step
        @reload="reload"
        ref="newStepComponent"
        :consultationFlowId="consultationFlow.id"
    ></modal-new-step>
  <hr>
  <div id="myDiagramDiv" style="border: solid 1px black; width:1500px; height:1000px; background:#eee"></div>

</template>

<script>
import modalNewMotifConsultation from "./modal-new-motif-consultation.vue";
import modalNewStep from "./modal-new-step.vue";
import axios from "axios";
import Routing from "fos-router";
import go from 'gojs';
import { isProxy, toRaw } from 'vue';

var $ = go.GraphObject.make

const myDiagram = null;
export default {
  components: {
    modalNewMotifConsultation,
    modalNewStep
  },
  data() {
    return {
      consultationFlow: {
        id: null,
        reason: null,
        steps: [
          {
            "key": 1,
            "position": 1,
            "name" : "",
            "examens" : [],

          }
        ]
      },
      listConsultation:{

      },
      consultationMotif: '',
      listExamen: [
      ],
      currentStep: null,
      loading:true,
    }
  },
  async mounted() {
    await this.load()
    this.loading = false;
  },
  methods: {
    async load() {
      await axios.get(Routing.generate('api_consultation_reason_get'))
          .then(response => {
            this.listConsultation = response.data
          })

      if(typeof entityId !== 'undefined') {
        await axios.get(Routing.generate('api_consultation_flow_get' , {'id': entityId}))
            .then(response => {
              this.consultationFlow = response.data
            })
      }


      this.init()
    },
    init() {

      const $ = go.GraphObject.make;
      var ml8 = new go.Margin(0, 0, 0, 8);
      var roundedRectangleParams = {
        parameter1: 2,  // set the rounded corner
        spot1: go.Spot.TopLeft, spot2: go.Spot.BottomRight  // make content go all the way to inside edges of rounded corners
      };

      this.myDiagram =
          $(go.Diagram, "myDiagramDiv",  // the DIV HTML element
              {
                allowCopy: false,
                allowDelete: false,
                initialDocumentSpot: go.Spot.Top,
                initialViewportSpot: go.Spot.Top,
                maxSelectionCount: 1,
                validCycle: go.Diagram.CycleDestinationTree,
                "clickCreatingTool.insertPart": function(loc) {
                  const node = go.ClickCreatingTool.prototype.insertPart.call(this, loc);
                  if (node !== null) {
                    this.diagram.select(node);
                    this.diagram.commandHandler.scrollToPart(node);
                    this.diagram.commandHandler.editTextBlock(node.findObject("NAMETB"));
                  }
                  return node;
                },
                layout:
                    $(go.TreeLayout,
                        {
                          treeStyle: go.TreeLayout.StyleLastParents,
                          arrangement: go.TreeLayout.ArrangementHorizontal,
                          angle: 90,
                          layerSpacing: 50,
                          alternateAngle: 90,
                          alternateLayerSpacing: 35,
                          alternateAlignment: go.TreeLayout.AlignmentBus,
                          alternateNodeSpacing: 50
                        }),
                "undoManager.isEnabled": true
              });

      function textStyle(field, title) {
        return [
          {
            visible: false ,
            maxLines: 1,
            margin: 5,
            width: 150
          },
          new go.Binding("visible", field, val => val !== undefined),
          new go.Binding("text", field, val => title + " : " + val)
        ];
      }
      // define the Node template
      this.myDiagram.nodeTemplate =
          $(go.Node, "Auto",
              {
                locationSpot: go.Spot.Top,
                isShadowed: true, shadowBlur: 1,
                shadowOffset: new go.Point(0, 1),
                shadowColor: "rgba(0, 0, 0, .14)",
                mouseEnter: (e, node, prev) => {
                  node.findObject("BUTTONX").opacity = node.findObject("BUTTONX").opacity = 1
                  node.findObject("BUTTON+").opacity = node.findObject("BUTTON+").opacity = 1
                },
                mouseLeave: (e, node, prev) => {
                  node.findObject("BUTTONX").opacity = node.findObject("BUTTONX").opacity = 0
                  node.findObject("BUTTON+").opacity = node.findObject("BUTTON+").opacity = 0
                },
                mouseDragEnter: (e, node, prev) => {
                  const diagram = node.diagram;
                  const selnode = diagram.selection.first();
                  if (!mayWorkFor(selnode, node)) return;
                  const shape = node.findObject("SHAPE");
                  if (shape) {
                    shape._prevFill = shape.fill;  // remember the original brush
                    shape.fill = "darkred";
                  }
                },
                mouseDragLeave: (e, node, next) => {
                  const shape = node.findObject("SHAPE");
                  if (shape && shape._prevFill) {
                    shape.fill = shape._prevFill;  // restore the original brush
                  }
                },
                mouseDrop: (e, node) => {
                  const diagram = node.diagram;
                  const selnode = diagram.selection.first();  // assume just one Node in selection
                  if (mayWorkFor(selnode, node)) {
                    // find any existing link into the selected node
                    const link = selnode.findTreeParentLink();
                    if (link !== null) {  // reconnect any existing link
                      link.fromNode = node;
                    } else {  // else create a new link
                      diagram.toolManager.linkingTool.insertLink(node, node.port, selnode, selnode.port);
                    }
                  }
                }
              },
              $(go.Shape, "RoundedRectangle", roundedRectangleParams,
                  { name: "SHAPE", fill: "#ffffff", strokeWidth: 0 },
                  // gold if highlighted, white otherwise
                  new go.Binding("fill", "isHighlighted", h => h ? "gold" : "#ffffff").ofObject()
              ),
              $(go.Panel, "Vertical",
                  $(go.Panel, "Horizontal",
                      { margin: 8 },
                      $(go.Panel, "Table",
                          $(go.TextBlock,
                              {
                                row: 0, alignment: go.Spot.Left,
                                font: "bold 12px Roboto, sans-serif",
                                stroke: "rgba(0, 0, 0, .87)",
                                maxLines: 1
                              },
                              new go.Binding("text", "name")
                          ),

                          $("PanelExpanderButton", "INFO",
                              { row: 0, column: 1, rowSpan: 2, margin: ml8 }
                          )
                      ),
                      $("Button",
                          $(go.Shape, "XLine", { width: 10, height: 10 }),
                          {
                              name: "BUTTONX", alignment: go.Spot.TopCenter, opacity: 0,  // initially not visible
                              click: (e, button) => this.removeStep(button.part)
                          },
                          // button is visible either when node is selected or on mouse-over
                          new go.Binding("opacity", "isSelected", s => s ? 1 : 0).ofObject()
                      ),
                  ),
                  $(go.Shape, "LineH",
                      {
                        stroke: "rgba(0, 0, 0, .60)", strokeWidth: 1,
                        height: 1, stretch: go.GraphObject.Horizontal
                      },
                      new go.Binding("visible").ofObject("INFO")  // only visible when info is expanded
                  ),
                  $(go.Panel, "Vertical",
                      {
                        name: "INFO",  // identify to the PanelExpanderButton
                        stretch: go.GraphObject.Horizontal,  // take up whole available width
                        margin: 10,
                        defaultAlignment: go.Spot.Left,  // thus no need to specify alignment on each element
                      },

                      $(go.TextBlock, textStyle("triggerValue", "Valeur attendue")),

                      $(go.TextBlock, "Examens cliniques: ", { font:"bold 12px Roboto, sans-serif", maxLines: 1, margin: 5, width: 150, isUnderline: true }),

                      $(go.Panel, "Vertical",
                          new go.Binding("itemArray", "examens"),
                          {
                              itemTemplate:
                                  $(go.Panel, "Auto",
                                      { margin: 5 },
                                      $(go.Shape, "RoundedRectangle",
                                          { fill: "#91E3E0" }),
                                      $(go.TextBlock, new go.Binding("text", "name"),
                                          { margin: 2, maxLines: 2, font:"bold 10px Roboto, sans-serif" }),
                                  )
                          },
                          {defaultAlignment: go.Spot.Left}
                          //new go.Binding("itemArray", "examens"),
                          //new go.Binding("itemArray", "availableValues"),
                      )
                  ),
                  $("Button",
                      $(go.Shape, "PlusLine", { width: 10, height: 10 }),
                      {
                        name: "BUTTON+", alignment: go.Spot.BottomCenter, opacity: 0,  // initially not visible
                        click: (e, button) => this.addStep(button.part)
                      },
                      // button is visible either when node is selected or on mouse-over
                      new go.Binding("opacity", "isSelected", s => s ? 1 : 0).ofObject()
                  ),
                  new go.Binding("isTreeExpanded").makeTwoWay(),
                  $("TreeExpanderButton",
                      {
                        name: "BUTTONX", alignment: go.Spot.Top, opacity: 0,
                        "_treeExpandedFigure": "TriangleUp",
                        "_treeCollapsedFigure": "TriangleDown"
                      },
                      {
                        name: "BUTTON+", alignment: go.Spot.BottomCenter, opacity: 0,
                        "_treeExpandedFigure": "TriangleUp",
                        "_treeCollapsedFigure": "TriangleDown"
                      },
                      new go.Binding("opacity", "isSelected", s => s ? 1 : 0).ofObject()
                  ),
              )
          );

      // define the Link template, a simple orthogonal line
      // set up the nodeDataArray, describing each person/position
      const consultationFlow = toRaw(this.consultationFlow);
      if(consultationFlow.id === null) {
        consultationFlow.steps.push()
      }
      // create the Model with data for the tree, and assign to the Diagram
      this.myDiagram.model =
          new go.TreeModel(
              {
                nodeParentKeyProperty: "previousStepKey",  // this property refers to the parent node data
                nodeDataArray: consultationFlow.steps
              }
          );

    },
    addStep(node) {
      if(!node) return
      this.loading = true;
      this.currentStep = node.data
      this.$refs.newStepComponent.openModal(node.data)
    },
    editStep(node) {
      if(!node) return
      this.loading = true;
      this.currentStep = node.data
      this.$refs.newStepComponent.editModal(node.data)
    },
    removeStep(node) {
      if(!node) return
      this.loading = true;
      axios.delete(Routing.generate('api_consultation_flow_remove_step', {'id': node.data.key}))
      this.reload()
    },
    async reload() {
      this.loading = true;

      this.myDiagram.model.clear();
      await new Promise(r => setTimeout(r, 500));
      await axios.get(Routing.generate('api_consultation_flow_get' , {'id': entityId}))
          .then(response => {
            this.consultationFlow = response.data
          })
      const consultationFlow = toRaw(this.consultationFlow);
      // create the Model with data for the tree, and assign to the Diagram
      this.myDiagram.model =
          new go.TreeModel(
              {
                nodeParentKeyProperty: "previousExamen",  // this property refers to the parent node data
                nodeDataArray: consultationFlow.steps
              }
          );

      this.loading = false;

    }
  }
}
</script>
<style scoped>

</style>