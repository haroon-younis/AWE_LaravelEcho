<template>
  <div class="composer">
    <!-- text are to input a message. Once enter key has been pressed it will trigger the send method-->
    <textarea v-model="message" @keydown.enter="send" placeholder="Write a message"></textarea>

  </div>
</template>

<script>
  export default {
    data() {
      return {
          message: ''
      };
    },
    methods: {
      send(e) {
        e.preventDefault(); // when enter key is pressed message will be sent

        if (this.message == '') { // checks if we have a message
          return;
        }

        this.$emit('send', this.message); // emit event send with the message
        this.message = ''; // clearing textarea
      }
    }
  }
</script>

<!-- css -->
<style lang="scss" scoped>
.composer textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
</style>
