.PHONY: \
	fix \
	stan \
	mess \
	sal \
	list

PHPCSFIXER_BIN := ./vendor/bin/php-cs-fixer
PHPSTAN_BIN := ./vendor/bin/phpstan
PHPMD_BIN := ./vendor/bin/phpmd
PHPSALM_BIN := ./vendor/bin/psalm

########## Comandos ##########

fix:
	-$(PHPCSFIXER_BIN) fix -v

stan:
	-$(PHPSTAN_BIN) analyze --level=7 -c phpstan.neon

mess:
	-$(PHPMD_BIN) ./app/ text ruleset.xml

sal:
	-$(PHPSALM_BIN)

list:
	@echo ""
	@echo "Desarrollo:"
	@echo ""
	@echo "  fix      > Modifica los archivos PHP según el CS"
	@echo "  stan     > Analiza el código PHP buscando errores"
	@echo "  mess     > Analiza el código PHP buscando errores"
	@echo "  sal      > Analiza el código PHP buscando errores"
