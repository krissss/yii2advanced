const path = require('path')
const fs = require('fs')

const entries = []
const items = fs.readdirSync(path.join(__dirname, 'entry'))
items.forEach(item => {
  if (path.extname(item) === '.js') {
    entries.push({name: item.substring(0, item.lastIndexOf('.')), src: path.join(__dirname, 'entry', item)})
  }
})

module.exports = {
  entries
}
