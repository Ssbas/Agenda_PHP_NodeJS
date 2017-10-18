const RouterEventos = require('express').Router();
//const Evento = require('./modelEventos.js')
const Evento = require('./modelEventos.js')
const Operaciones = require('./crud.js')

// Obtener un usuario por su id
RouterEventos.get('/all', function(req, res) {
  Evento.find({}).exec(function(err, doc){
      if (err) {
          res.status(500)
          res.json(err)
      }
      res.json(doc)
  })
})

RouterEventos.all('/', function(req, res) {
  res.send('Mostrar main.html')
  res.end()
})

// Agregar a un usuario
RouterEventos.post('/new', function(req, res) {
    let
        title = req.body.title,
        start = req.body.start,
        end = req.body.end

    let evento = new Evento({
      title: title,
      start: start,
      end: end,
      //fk_usuarios: 'demo'//{ type: Schema.ObjectId, ref: 'Usuarios' }
    })
    evento.save(function(error) {
        if (error) {
            res.status(500)
            res.json(error)
        }
        res.send("Evento guardado")
    })
})

// Eliminar un usuario por su id
RouterEventos.post('/delete/:_id', function(req, res) {
    let id = req.params._id
    Evento.remove({_id: id}, function(error) {
        if(error) {
            res.status(500)
            res.json(error)
        }
        res.send("Registro eliminado")
    })
})

RouterEventos.get('/update/:_id&:start&:end', function(req, res) {
    Evento.findOne({_id:req.params._id}).exec((error, result) => {
    console.log(req.params);
    let id    = req.params._id,
        start = req.params.start,
        end   = req.params.end
        console.log(req.params)
          if (error){
            res.send(error)
          }else{
            Evento.update({_id: id}, {start:start, end:end}, (error, result) => {
                if (error){
                  res.send(error)
                }else{
                  res.send("Evento ha sido actualizado")
                }
            })
          }
      })
      //res.send('id')//req.params.id +' '+ req.params.start + ' ' + req.params.end)
      //res.end()
})

module.exports = RouterEventos