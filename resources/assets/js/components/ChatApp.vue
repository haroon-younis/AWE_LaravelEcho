<template>
    <div class="chat-app">
      <!-- when 'new' event is fired a method is triggered-->
      <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
      <ContactsList :contacts="contacts" @selected="startConversionWith"/>
    </div>
</template>

<script>
  import Conversation from './Conversation';
  import ContactsList from './ContactsList';

    export default {
        props: {
          user: {
            type: Object,
            required: true
          }
        },

        data() {
          return {
            selectedContact: null,
            messages: [],
            contacts: []
          };
        },

        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message); // calls method
                })

            axios.get('/contacts')
                 .then((response) => {
                     this.contacts = response.data;
                 });
        },
        methods: {
          startConversionWith(contact) {
            axios.get(`/conversation/${contact.id}`)
                 .then((response) => {
                   this.messages = response.data;
                   this.selectedContact = contact;
                 })
          },
          saveNewMessage(text) {
            // send message
            this.messages.push(text);
          },
          handleIncoming(message) {
              // checks to see if we are in a conversation
              if (this.selectedContact && message.from == this.selectedContact.id) {
                  this.saveNewMessage(message);
                  return;
              }

              alert(message.text);
          }
        }, // end of methods
        components: {Conversation,  ContactsList}
    }
</script>

<!-- css -->
<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
