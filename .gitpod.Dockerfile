FROM gitpod/workspace-postgres
                    
USER gitpod

RUN sudo add-apt-repository ppa:ondrej/php

RUN sudo apt-get install php-bcmath -y

RUN composer global require hirak/prestissimo
