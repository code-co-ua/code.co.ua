FROM gitpod/workspace-postgres
                    
USER gitpod

RUN sudo add-apt-repository ppa:ondrej/php

RUN sudo apt-get install php7.2-bcmath -y

# Composer plugin to speed up the installation process
RUN composer global require hirak/prestissimo
