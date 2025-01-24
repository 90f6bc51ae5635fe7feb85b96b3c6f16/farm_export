pipeline {
    agent any
    tools {
        nodejs "node-14.20.0"
    }
    
    stages {
        stage('set-env') {
            steps {
                setenv()
            }
        }
        stage('SSH Login with Username and Password') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'ssh_to_main', usernameVariable: 'USER', passwordVariable: 'PASS')]) {
                    sh """
                        sshpass -p $PASS ssh -o StrictHostKeyChecking=no $USER@203.158.7.100 '
                        cd $APP_PATH
                        git restore . && git restore --staged . && git clean -fd
                        git fetch
                        git checkout sut-deploy
                        git pull
                        '
                    """
                }
            }
        }
        // stage('pull'){
        //     steps {
        //         script {
        //             sh """ 
        //             ls

        //             cd ${APP_PATH}

        //             git pull 
        //             "
        //             """
        //         }
        //     }  
        // }


        // stage('deploy'){
        //     steps {
        //         script {
        //                 sshagent(['ssh_to_42']) {
        //                     sh """ 
        //                     ssh -tt -o StrictHostKeyChecking=no root@141.98.19.42 " 

        //                     cd ${APP_PATH}
                          
        //                     docker pull ${APP_REGISTRY}/${APP_NAME}:${APP_VERSION}

        //                     APP_VERSION=${APP_VERSION} docker-compose  up revelsoft_mtp_client -d 

        //                     echo "Clear docker image."
                          
        //                     docker image prune -f

        //                     "
        //                     """
        //                 }
        //         }
        //     }
        // }
    }
}

def setenv(){
    def envapp = readYaml file: "env-app.yaml"
    APP_REGISTRY = envapp.App.Registry
    APP_BRANCH = envapp.App.Branch
    APP_NAME = envapp.App.AppName
    APP_VERSION = envapp.App.AppVersion
    APP_PATH = envapp.App.AppPath 
}
