new Chart(document.getElementById("card-chart1"), {
    type: "line",
    backgroundColor: "transparent",
    borderWidth: 1,
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Prueba",
            data: [65, 59, 84, 84, 51, 54, 40],
            borderColor: "rgba(255, 255, 255,0.7)",
            pointBackgroundColor: "#11549E",
            pointRadius: 4,
            lineTension: 0.4,
            backgroundColor: 'transparent',
            borderWidth: 1,
        }, ],
    },
    options: {
        title: {
            display: false,
            text: 'Custom Chart Title'
        },
        legend: {
            display: false
        },
        tooltips: {
            enabled: false,
            custom: function(tooltipModel) {
                // Tooltip Element
                var tooltipEl = document.getElementById('chartjs-tooltip');

                // Create element on first render
                if (!tooltipEl) {
                    tooltipEl = document.createElement('div');
                    tooltipEl.id = 'chartjs-tooltip';
                    tooltipEl.classList.add("chartjs-tooltip");
                    tooltipEl.classList.add("top");
                    tooltipEl.classList.add("bottom");
                    tooltipEl.innerHTML = '<div></div>';
                    document.body.appendChild(tooltipEl);
                }

                // Hide if no tooltip
                if (tooltipModel.opacity === 0) {
                    tooltipEl.style.opacity = 0;
                    return;
                }

                // Set caret Position
                tooltipEl.classList.remove('above', 'below', 'no-transform');
                if (tooltipModel.yAlign) {
                    tooltipEl.classList.add(tooltipModel.yAlign);
                } else {
                    tooltipEl.classList.add('no-transform');
                }

                function getBody(bodyItem) {
                    return bodyItem.lines;
                }

                // Set Text
                if (tooltipModel.body) {
                    var titleLines = tooltipModel.title || [];
                    var bodyLines = tooltipModel.body.map(getBody);
                    var innerHtml = '<div class="tooltip-header">';

                    titleLines.forEach(function(title) {
                        innerHtml += '<div class="tooltip-header-item">' + title + '</div>';
                    });
                    innerHtml += '</div><div class="tooltip-body">';

                    bodyLines.forEach(function(body, i) {
                        innerHtml += '<div class="tooltip-body-item">';
                        var colors = tooltipModel.labelColors[i];

                        innerHtml += '<span class="tooltip-body-item-color" style="background-color:' + colors.backgroundColor + ';"></span>';
                        innerHtml += '<span class="tooltip-body-item-label">' + body[0].split(": ")[0] + '</span>';
                        innerHtml += '<span class="tooltip-body-item-value">' + body[0].split(": ")[1] + '</span>';
                        innerHtml += "</div>";
                    });
                    innerHtml += '</div>';

                    var tableRoot = tooltipEl.querySelector('div');
                    tableRoot.innerHTML = innerHtml;
                }

                // `this` will be the overall tooltip
                var position = this._chart.canvas.getBoundingClientRect();

                // Display, position, and set styles for font
                tooltipEl.style.opacity = 1;
                tooltipEl.style.position = 'block';
                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';
                tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
                tooltipEl.style.pointerEvents = 'none';
            }
        },
        scales: {
            xAxes: [{
                display: false,

            }],
            yAxes: [{
                display: false,
                ticks: {
                    max: 85,
                    min: 39,
                    stepSize: 0.5
                }
            }]
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 5,
                bottom: 15
            }
        }
    }
});

new Chart(document.getElementById("card-chart2"), {
    type: "line",
    backgroundColor: "transparent",
    borderWidth: 1,
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Prueba",
            data: [1, 18, 9, 17, 34, 22, 11],
            borderColor: "rgba(255, 255, 255,0.7)",
            pointBackgroundColor: "#39f",
            pointRadius: 4,
            lineTension: 0,
            backgroundColor: 'transparent',
            borderWidth: 1,
        }, ],
    },
    options: {
        title: {
            display: false,
            text: 'Custom Chart Title'
        },
        legend: {
            display: false
        },
        tooltips: {
            enabled: false,
            custom: function(tooltipModel) {
                // Tooltip Element
                var tooltipEl = document.getElementById('chartjs-tooltip');

                // Create element on first render
                if (!tooltipEl) {
                    tooltipEl = document.createElement('div');
                    tooltipEl.id = 'chartjs-tooltip';
                    tooltipEl.classList.add("chartjs-tooltip");
                    tooltipEl.classList.add("top");
                    tooltipEl.classList.add("bottom");
                    tooltipEl.innerHTML = '<div></div>';
                    document.body.appendChild(tooltipEl);
                }

                // Hide if no tooltip
                if (tooltipModel.opacity === 0) {
                    tooltipEl.style.opacity = 0;
                    return;
                }

                // Set caret Position
                tooltipEl.classList.remove('above', 'below', 'no-transform');
                if (tooltipModel.yAlign) {
                    tooltipEl.classList.add(tooltipModel.yAlign);
                } else {
                    tooltipEl.classList.add('no-transform');
                }

                function getBody(bodyItem) {
                    return bodyItem.lines;
                }

                // Set Text
                if (tooltipModel.body) {
                    var titleLines = tooltipModel.title || [];
                    var bodyLines = tooltipModel.body.map(getBody);
                    var innerHtml = '<div class="tooltip-header">';

                    titleLines.forEach(function(title) {
                        innerHtml += '<div class="tooltip-header-item">' + title + '</div>';
                    });
                    innerHtml += '</div><div class="tooltip-body">';

                    bodyLines.forEach(function(body, i) {
                        innerHtml += '<div class="tooltip-body-item">';
                        var colors = tooltipModel.labelColors[i];

                        innerHtml += '<span class="tooltip-body-item-color" style="background-color:' + colors.backgroundColor + ';"></span>';
                        innerHtml += '<span class="tooltip-body-item-label">' + body[0].split(": ")[0] + '</span>';
                        innerHtml += '<span class="tooltip-body-item-value">' + body[0].split(": ")[1] + '</span>';
                        innerHtml += "</div>";
                    });
                    innerHtml += '</div>';

                    var tableRoot = tooltipEl.querySelector('div');
                    tableRoot.innerHTML = innerHtml;
                }

                // `this` will be the overall tooltip
                var position = this._chart.canvas.getBoundingClientRect();

                // Display, position, and set styles for font
                tooltipEl.style.opacity = 1;
                tooltipEl.style.position = 'block';
                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';
                tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
                tooltipEl.style.pointerEvents = 'none';
            }
        },
        scales: {
            xAxes: [{
                display: false,

            }],
            yAxes: [{
                display: false,
                ticks: {
                    max: 34,
                    min: 1,
                    stepSize: 0.5
                }
            }]
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 15
            }
        }
    }
});

new Chart(document.getElementById("card-chart3"), {
    type: "line",
    backgroundColor: "transparent",
    borderWidth: 1,
    responsive: true,
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Prueba",
            data: [78, 81, 80, 45, 34, 12, 40],
            borderColor: "rgba(255, 255, 255,0.7)",
            pointBackgroundColor: "transparent",
            pointBorderColor: "transparent",
            pointRadius: 4,
            lineTension: 0.5,
            backgroundColor: 'rgba(255,255,255,0.2)',
            borderWidth: 2,
        }, ],
    },
    options: {
        title: {
            display: false,
            text: 'Custom Chart Title'
        },
        legend: {
            display: false
        },
        tooltips: {
            enabled: false,
            custom: function(tooltipModel) {
                // Tooltip Element
                var tooltipEl = document.getElementById('chartjs-tooltip');

                // Create element on first render
                if (!tooltipEl) {
                    tooltipEl = document.createElement('div');
                    tooltipEl.id = 'chartjs-tooltip';
                    tooltipEl.classList.add("chartjs-tooltip");
                    tooltipEl.classList.add("top");
                    tooltipEl.classList.add("bottom");
                    tooltipEl.innerHTML = '<div></div>';
                    document.body.appendChild(tooltipEl);
                }

                // Hide if no tooltip
                if (tooltipModel.opacity === 0) {
                    tooltipEl.style.opacity = 0;
                    return;
                }

                // Set caret Position
                tooltipEl.classList.remove('above', 'below', 'no-transform');
                if (tooltipModel.yAlign) {
                    tooltipEl.classList.add(tooltipModel.yAlign);
                } else {
                    tooltipEl.classList.add('no-transform');
                }

                function getBody(bodyItem) {
                    return bodyItem.lines;
                }

                // Set Text
                if (tooltipModel.body) {
                    var titleLines = tooltipModel.title || [];
                    var bodyLines = tooltipModel.body.map(getBody);
                    var innerHtml = '<div class="tooltip-header">';

                    titleLines.forEach(function(title) {
                        innerHtml += '<div class="tooltip-header-item">' + title + '</div>';
                    });
                    innerHtml += '</div><div class="tooltip-body">';

                    bodyLines.forEach(function(body, i) {
                        innerHtml += '<div class="tooltip-body-item">';
                        var colors = tooltipModel.labelColors[i];

                        innerHtml += '<span class="tooltip-body-item-color" style="background-color:' + colors.backgroundColor + ';"></span>';
                        innerHtml += '<span class="tooltip-body-item-label">' + body[0].split(": ")[0] + '</span>';
                        innerHtml += '<span class="tooltip-body-item-value">' + body[0].split(": ")[1] + '</span>';
                        innerHtml += "</div>";
                    });
                    innerHtml += '</div>';

                    var tableRoot = tooltipEl.querySelector('div');
                    tableRoot.innerHTML = innerHtml;
                }

                // `this` will be the overall tooltip
                var position = this._chart.canvas.getBoundingClientRect();

                // Display, position, and set styles for font
                tooltipEl.style.opacity = 1;
                tooltipEl.style.position = 'block';
                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';
                tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
                tooltipEl.style.pointerEvents = 'none';
            }
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    max: 85,
                    min: 0,
                    stepSize: 0.5
                }
            }]
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 10,
                bottom: 0
            }
        }
    }
});

new Chart(document.getElementById("card-chart4"), {
    type: "bar",
    backgroundColor: "transparent",
    borderWidth: 1,
    responsive: true,
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March", "April"],
        datasets: [{
            label: "Prueba",
            data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98, 34, 84, 67, 82],
            borderColor: "rgba(255, 255, 255,0.7)",
            pointBackgroundColor: "transparent",
            pointBorderColor: "transparent",
            pointRadius: 2,
            lineTension: 0,
            backgroundColor: 'rgba(255,255,255,0.2)',
            borderWidth: 0,
            barPercentage: 0.7
        }, ],
    },
    options: {
        title: {
            display: false,
            text: 'Custom Chart Title'
        },
        legend: {
            display: false
        },
        tooltips: {
            enabled: false,
            custom: function(tooltipModel) {
                // Tooltip Element
                var tooltipEl = document.getElementById('chartjs-tooltip');

                // Create element on first render
                if (!tooltipEl) {
                    tooltipEl = document.createElement('div');
                    tooltipEl.id = 'chartjs-tooltip';
                    tooltipEl.classList.add("chartjs-tooltip");
                    tooltipEl.classList.add("top");
                    tooltipEl.classList.add("bottom");
                    tooltipEl.innerHTML = '<div></div>';
                    document.body.appendChild(tooltipEl);
                }

                // Hide if no tooltip
                if (tooltipModel.opacity === 0) {
                    tooltipEl.style.opacity = 0;
                    return;
                }

                // Set caret Position
                tooltipEl.classList.remove('above', 'below', 'no-transform');
                if (tooltipModel.yAlign) {
                    tooltipEl.classList.add(tooltipModel.yAlign);
                } else {
                    tooltipEl.classList.add('no-transform');
                }

                function getBody(bodyItem) {
                    return bodyItem.lines;
                }

                // Set Text
                if (tooltipModel.body) {
                    var titleLines = tooltipModel.title || [];
                    var bodyLines = tooltipModel.body.map(getBody);
                    var innerHtml = '<div class="tooltip-header">';

                    titleLines.forEach(function(title) {
                        innerHtml += '<div class="tooltip-header-item">' + title + '</div>';
                    });
                    innerHtml += '</div><div class="tooltip-body">';

                    bodyLines.forEach(function(body, i) {
                        innerHtml += '<div class="tooltip-body-item">';
                        var colors = tooltipModel.labelColors[i];

                        innerHtml += '<span class="tooltip-body-item-color" style="background-color:' + colors.backgroundColor + ';"></span>';
                        innerHtml += '<span class="tooltip-body-item-label">' + body[0].split(": ")[0] + '</span>';
                        innerHtml += '<span class="tooltip-body-item-value">' + body[0].split(": ")[1] + '</span>';
                        innerHtml += "</div>";
                    });
                    innerHtml += '</div>';

                    var tableRoot = tooltipEl.querySelector('div');
                    tableRoot.innerHTML = innerHtml;
                }

                // `this` will be the overall tooltip
                var position = this._chart.canvas.getBoundingClientRect();

                // Display, position, and set styles for font
                tooltipEl.style.opacity = 1;
                tooltipEl.style.position = 'block';
                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';
                tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
                tooltipEl.style.pointerEvents = 'none';
            }
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    max: 100,
                    min: 0,
                    stepSize: 0.5
                }
            }]
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    }
});