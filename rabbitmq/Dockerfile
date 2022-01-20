FROM rabbitmq:3-management-alpine

# Define environment variables.
ENV RABBITMQ_USER user
ENV RABBITMQ_PASSWORD user
ENV RABBITMQ_PID_FILE /var/lib/rabbitmq/mnesia/rabbitmq
ENV RABBITMQ_DEFAULT_VHOST laravel-host

ADD rabbitmq.sh /rabbitmq.sh
RUN chmod +x /rabbitmq.sh
EXPOSE 15672

# Define default command
CMD ["/rabbitmq.sh"]
