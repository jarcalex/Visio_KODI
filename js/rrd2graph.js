var graphconf;
var active_host;
var active_graph;
var data;


function getData( name ){

  if ( 0 ) {
    return eval("(" + localStorage.getItem(name) + ')');
  }
  else
  {
    return $.ajax({
      url: '/www/web/' + name + '.json',
      dataType: 'json',
      async: false,
      success: function(data) {
        localStorage.setItem(name, JSON.stringify(data))
        return data
      },
      fail: function () {
        return null
      }
    }).responseJSON
  }
}


function Start() {
  
  graphconf = getData('rrd2graph');
  active_host  = null;
  active_graph = null;
  SetHostlist();
}


function SetHostlist() {
  var hostlist = "Host: <select id='selected_host'>\n";
  
  hostlist += "<option value=''";  
  if (active_host == null) {
    hostlist += " selected ";
  }
  hostlist += "> </option>\n";
  
  var host;
  for (host in graphconf) {
    // alert("Host: " + host);
    hostlist += "<option value='" + host + "'";
    if (active_host == host) {
      hostlist += " selected ";
    }
    hostlist += ">" + host + "</option>\n";
  }
  hostlist += "</select>\n";

  $("#mygraph_Host_title").html(hostlist);
  
  $('#selected_host').on('change', function (e) {
    active_host = this.value;
    localStorage.setItem('active_host', active_host);
    active_graph = "";
    localStorage.setItem('active_graph', active_graph);
    SetGraphlist2host();
  });
}

function SetGraphlist2host() {
  var graphlist = "Graph: <select id='selected_graph'>\n";
  
  var HostGraph = graphconf[active_host];
  graphlist += "<option value=''";  
  if (active_graph == null) {
    graphlist += " selected ";
  }
  graphlist += "> </option>\n";
  
  for (var graph in HostGraph) {
    // alert(HostGraph[graph].name);
	graphlist += "<option value='" + graph + "'";
    if (active_graph == graph) {
      graphlist += " selected ";
    }
    graphlist += ">" + HostGraph[graph].name + "</option>\n";
  }
  graphlist += "</select>\n";
  
  $("#mygraph_Graph_title").html(graphlist);
  
  $('#selected_graph').on('change', function (e) {
    active_graph = this.value;
    localStorage.setItem('active_graph', active_graph);
    $('#preloader').removeClass('hide');
    FetchGraph();
    $('#preloader').addClass('hide');
  });
}


function FetchGraph() {
  
  var RRDList = graphconf[active_host][active_graph].RRD;
  // Si un seul fichier RRD pour le graph
  if( typeof RRDList === 'string' ) {
	var tmp = RRDList;
	delete RRDList; 
	var RRDList = [];
    RRDList[0] = tmp;
  }
  var index = 0;
  for (var rrdfile in RRDList) {
    try {
      FetchBinaryURLAsync('/www/web/stat/' + active_host + "_" + rrdfile + '.rrd', UpdateHandler, rrdfile + index);
    }
    catch (err) {
      alert("Failed loading stat/" + active_host + "_" + rrdfile + ".rrd\n" + err);
    }
	index++;
  }
}


function UpdateHandler(bf, rrdfile) {
  idx = rrdfile.slice(-1);
  rrdfile = rrdfile.slice(0, -1);

  RRDList = graphconf[active_host][active_graph].RRD;
  try {
    rrd_data[idx] = new RRDFile(bf);
  } catch (err) {
    alert("File stat/" + active_host + "_" + rrdfile + ".rrd is not a valid RRD archive!");
  }
  PrepareGraph(idx, rrdfile);
  
  index = 0;
  ready = 0;
  for (var rrdfile in RRDList) {
    if (rrd_data[index] != undefined) {
      ready++
    }
	index++
  }
  if (ready == index) {
    UpdateGraph()
  }
}


function PrepareGraph(idx, file) {
  // http://javascriptrrd.sourceforge.net/docs/javascriptrrd_v0.6.0/src/examples/rrdJFlotFilter.html
  // http://sourceforge.net/p/javascriptrrd/discussion/914914/thread/935d8541/#17d3
  // Create a RRDFilterOp object that has the all DS's, with the one
  // existing in the original RRD populated with real values, and the other set to 0.
  graph = graphconf[active_host][active_graph].RRD;
  var op_list = []; //list of operations
  //create a new rrdlist, which contains all original elements (kept the same by DoNothing())
  for (var rrdfile in graph) {
  // for (var iloop = 0; iloop < graph.length; iloop++) {
    if (rrdfile != file) {
      op_list.push(new Zero(rrdfile));
    }
    else {
      op_list.push(new DoNothing(rrd_data[idx].getDS(0).getName()));
    }
  }
  rrd_data[idx] = new RRDFilterOp(rrd_data[idx], op_list);
}


function UpdateGraph() {
  graph_options={};
  active_rra=localStorage.getItem('active_rra') || 0;
  rrdflot_defaults={ graph_width:"750px",graph_height:"285px", scale_width:"350px", scale_height:"90px", use_rra:true, rra:active_rra };
  RRDlist = graphconf[active_host][active_graph].RRD;
  
  var ds_graph = {};
  
  for(var graph in RRDlist) {
	// alert("Graph: " + graph);
	ds_graph[graph] = {};
    for(var param in RRDlist[graph]) {
	  // alert("Param: " + param);
      try {
		ds_graph[graph][param] =  RRDlist[graph][param]; 
      }
      catch(e) {
		  alert("Bug " + e + " Param: " + param + "  //  " + RRDlist[graph][param]);
      }
    }
  }
 
  if ( graphconf[active_host][active_graph].graph_options ) {
    for(var param in graphconf[active_host][active_graph].graph_options) {
      try {
        graph_options[param]=eval('(' + graphconf[active_host][active_graph].graph_options[param] + ')');
      }
      catch(e) {
      }
    }
  }

  rrd_data_sum = new RRDFileSum( rrd_data );
  var f = new rrdFlot("mygraph", rrd_data_sum, graph_options, ds_graph, rrdflot_defaults );
  //SetGraphlist();
  $('#preloader').addClass('hide');
  $('#Legend').addClass('hide');
}


function DoNothing(ds_name) {
  this.getName = function () {
    return ds_name;
  }
  this.getDSNames = function () {
    return [ds_name];
  }
  this.computeResult = function (val_list) {
    return val_list[0];
  }
}

function Zero(ds_name) { //create a fake DS.
  this.getName = function () {
    return ds_name;
  }
  this.getDSNames = function () {
    return [];
  }
  this.computeResult = function (val_list) {
    return 0;
  }
}

function SetValue(ds_name,value) { //create a fake DS.
  this.getName = function () {
    return ds_name;
  }
  this.getDSNames = function () {
    return [];
  }
  this.computeResult = function (val_list) {
    return value;
  }
}

$(function () {

  rrd_data = [];

  $.ajaxSetup({
    cache : false
  });

  Start();
});
