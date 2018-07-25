// progressbar.js@1.0.0 version is used
// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/
// console.log(total_modals);
for (var i = 0; i < total_modals; i++) {
  var id = "#progress"+String(i) ;
  // var count = document.getElementById('progress'+String(i)).value ;
  var selector = id+">input" ;
  var count = $(selector).val() ;

  if(count == 11)
  {
    var color = '#1BBC9B' ;
  }
  else{
    var color = '#ACB5C3';
  }

  // Declaration of bar with id progress.
var bar = addBar(count,color,id);
console.log(progressBars);
progressBars.push(bar);




}

// function to add progress bar and store in array
// receives color and progress bar value
function addBar(count,color,id){
  var bar = new ProgressBar.Line(id, {
    strokeWidth: 6,
    easing: 'easeInOut',
    duration: 1400,
    color: color,
    trailColor: '#FFF',
    trailWidth: 1,
    svgStyle: {width: '100%', height: '100%'},
    text: { // Text style.
      style: {
        // Text color.
        // Default: same as stroke color (options.color)
        color: '#000',
        position: 'absolute',
        width: '100%',
        // right:'45%',
        top: '100%',
        padding: 0,
        margin: 0,
        transform: null
      },
      autoStyleContainer: false
    },
    from: {color: '#1BBC9B'},
    to: {color: '#ACB5C3'},
    step: (state, bar) => {
      bar.setText(Math.round(bar.value() * 11) + '/11'); // text.
    }
  });

  bar.animate(count/11);  // Number from 0.0 to 1.0
  return bar;

}
