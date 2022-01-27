<template>
  <div>
    <half-circle-spinner
      :animation-duration="1000"
      :size="25"
      color="#fff"
      v-if="type == 1"
    />
    <hollow-dots-spinner
      :animation-duration="1000"
      :dot-size="15"
      :dots-num="3"
      color="#fff"
      v-if="type == 2"
    />
    <looping-rhombuses-spinner
      :animation-duration="2500"
      :rhombus-size="15"
      color="#fff"
      v-if="type == 3"
    />
  </div>
</template>

<script>
import {
  HalfCircleSpinner,
  HollowDotsSpinner,
  LoopingRhombusesSpinner,
} from "epic-spinners";
export default {
  props: { type: Number },
  components: { HalfCircleSpinner, HollowDotsSpinner, LoopingRhombusesSpinner },
};
</script>