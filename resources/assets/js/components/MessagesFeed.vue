<template>
  <div class="feed" ref="feed">
    <ul v-if="contact"> <!-- only outputs ul if we have a contact selected-->
      <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
        <!-- loop through messages -->
        <div class="text">
          {{ message.text }} <!-- Output message -->
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
      props: {
        contact: {
          type: Object,
        },
        messages: {
          type: Array,
          required: true
        }
      }, // end of props
      methods: {
          scrollToBottom() {
            setTimeout(() => {
              // scroll to bottom of feed
              this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50)
          }
      }, // end of methods
      watch: {
        contact(contact) { // once new contact is clicked
            this.scrollToBottom(); // scroll to bottom of feed
        },
        messages(messages) { // when new message is updated
            this.scrollToBottom(); // scroll to bottom of feed
        }
      }
  }
</script>

<!-- css -->
<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 470px;
    overflow: scroll;
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 10px 0;
                width: 100%;
                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
                &.received {
                    text-align: right;
                    .text {
                        background: #b2b2b2;
                    }
                }
                &.sent {
                    text-align: left;
                    .text {
                        background: #81c4f9;
                    }
                }
            }
        }
    }
}
</style>
