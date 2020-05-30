export const state = () => ({
    user: null,
    cards: null,
  })

// export const state = () => ({
//   user: {
//     name: 'test name',
//     username: 'testusername',
//     email: 'test@email.com',
//   },
//   cards: [
//     {
//       id: 0,  
//       title: 'TITLE',
//       author: 'AUTHOR',
//       text: 'Lorem',
//       imgUrl: '',
//       themes: ['THEME 1', 'THEME 2'],
//       contactVaries: [{contactType: 'telegram', value: '@contact'}, {contactType: 'gmail', value: 'contact@gmail.com'}, {contactType: 'vk', value:  'vk.com/contact'}]
//     },
//     {
//       id: 1,
//       title: 'TITLE',
//       author: 'AUTHOR',
//       text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam numquam mollitia eum cupiditate dolores asperiores architecto deserunt unde aliquam. Culpa tenetur modi quisquam ab illum quis distinctio voluptatem commodi quos?',
//       imgUrl: '',
//       themes: ['THEME 3', 'THEME 4'],
//       contactVaries: [{contactType: 'telegram', value: '@contact'}, {contactType: 'gmail', value: 'contact@gmail.com'}, {contactType: 'vk', value:  'vk.com/contact'}]
//     },
//     {
//       id: 2,
//       title: 'TITLE',
//       author: 'testusername',
//       text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam numquam mollitia eum cupiditate dolores asperiores architecto deserunt unde aliquam. Culpa tenetur modi quisquam ab illum quis distinctio voluptatem commodi quos?',
//       imgUrl: '',
//       themes: ['THEME 1', 'THEME 4'],
//       contactVaries: [{contactType: 'telegram', value: '@contact'}, {contactType: 'gmail', value: 'contact@gmail.com'}, {contactType: 'vk', value:  'vk.com/contact'}]
//     },
//   ],
  
// })

export const getters = {
  user: state => state.user,
  cards: state => state.cards,
}
export const mutations = {
  setUser(state, user) {
    state.user = user
  },
  setCards(state, data) {
    for(let each of data){
      each.themes = JSON.parse(each.themes)
      each.contacts = JSON.parse(each.contacts)
    }
    state.cards = data
  }
}
export const actions = {
  async nuxtServerInit(ctx){
      const token = this.$cookies.get('auth') || null
      if (token) {
          this.$axios.setToken(token, 'Bearer')
          await ctx.dispatch('fetchUser')
      }
  },
  async fetchUser(ctx) {
    try {
      const response = await this.$axios.get('http://localhost:8000/api/user')
      ctx.commit('setUser', response.data)
    } catch (error) {
      if (error.response.status == 401) {
        ctx.commit('setUser', null)
      }
    }
  },
  async fetchCards(ctx){
    try{
      const res = await this.$axios.get('http://localhost:8000/api/card/all')
      ctx.commit('setCards', res.data)
    } catch(error){
      if (error.response.status == 401) {
        ctx.commit('setUser', null)
      }
    }
  },
  async login(ctx, { email, password}) {
    return this.$axios.post('http://localhost:8000/api/get_token', {email, password})
    .then(async response => {
      const token = response.data
      this.$cookies.set('auth', token, {
        path: '/',
        maxAge: 60 * 60 * 24 * 7,
      })
    })
  },
  async register(ctx, {username, name, email, password}) {
    return await this.$axios.post('http://localhost:8000/api/register', {username, name, email, password})
  }
}
