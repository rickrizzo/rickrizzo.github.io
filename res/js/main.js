var AboutSection = React.createClass({
  render: function() {
    return(
      <div className="col-md-4 aboutme">
        <h2>{this.props.title}</h2>
        Not finished converting resume to json yet
      </div>
    );
  }
});

var About = React.createClass({
  render: function() {
    return(
      <div className="row">
        <AboutSection title="Projects" />
        <AboutSection title="Experience" />
        <AboutSection title="Skills" />
      </div>
    );
  }
});

React.render(
  <About />,
  document.getElementById('main')
);
