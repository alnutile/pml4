angular.module('pml4', [
    'pml4.controllers'
  ]);

angular.module('pml4.controllers', []).
    controller('IssuesCtrl', ['$scope', '$http', '$injector', function ($scope, $http, $injector) {
        $scope.project_id = 0;
        $scope.template = { name: 'github_issues', url: '/assets/js/templates/project_show.html'};

        $scope.getGitIssues = function (project_id, repo_owner, repo_name) {
            window.app.notice("Checking for missing issues", 'success');
            $scope.project_id = project_id;
            $http.get('/github/sync/project/' + project_id + '/' + repo_owner + '/' + repo_name + '').success(function(data) {
                $scope.issues = data;
            });
        };

        $scope.issuesChecked = [];

        $scope.issuesSyncAll = function () {
            var issues = $('input.issue-row[type=checkbox]');
            angular.forEach(issues, function(v, k) {
                var val = $(v).val();
                if( val !== 'all') {
                    $scope.postIssue(val);
                }
            });
        };

        $scope.issuesToSync = function( ) {
            var checked = $('input.sync[type=checkbox]:checked');
            angular.forEach(checked, function(v, k) {
                var val = $(v).val();
                if ( val === 'all') {
                    $scope.issuesSyncAll();
                    $('li.sync-all').fadeOut().remove();
                } else {
                    $scope.postIssue(val);
                }
             });
        };

        $scope.postIssue = function (val) {
            var uid = $('div#user-id').data('uid');
            var active = 0;
            angular.forEach($scope.issues, function(v, k){
                if (v.id == val ) {
                    var issue = v;
                    if ( issue.state === 'open' ) {
                        active = 1;
                    } else {
                        active = 0;
                    }
                    parameters = {
                        name: issue.title,
                        description: issue.body,
                        project_id: $scope.project_id,
                        user_id: uid,
                        active: active,
                        github_id: issue.id
                    };
                    $http.post('/projects/' + $scope.project_id + '/issues', parameters).success(function(data){
                        if ( data.errors === 0 ) {
                            window.app.notice("Your issue was added " + issue.title, 'success');
                            $scope.project_issues.push(data.data);
                            $('li#' + issue.id).fadeOut().remove();
                        } else {
                            window.app.notice("Error making your issue " + issue.title, 'error' )
                        }
                    });
                }
            });

        }

        $scope.issueList = { name: 'project_issues', url: '/assets/js/templates/project_issues.html'};
        var project_id = $('div#project-id').data('pid');
        $http.get('/projects/' + project_id).success(function(data){
            $scope.project_issues = data.data;
        });

    }]);
