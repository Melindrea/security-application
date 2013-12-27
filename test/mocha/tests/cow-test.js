/*global describe, it, expect, Cow */
'use strict';

(function () {
    // var sandbox;
    // beforeEach(function() {
    //     // // Create a sandbox
    //     // this.sandbox = sinon.sandbox.create();

    //     // // Stub some console methods
    //     // this.sandbox.stub(window.console, 'log');
    //     // this.sandbox.stub(window.console, 'error');
    // });

    // afterEach(function () {
    //     // // Restore the environment as it was before
    //     // this.sandbox.restore();
    // });

    describe('Cow', function () {
        describe('constructor', function() {
            it('should have a default name', function() {
                var cow = new Cow();
                expect(cow.name).to.equal('Anon cow');
            });

            it('should set cow\'s name if provided', function() {
                var cow = new Cow('Kate');
                expect(cow.name).to.equal('Kate');
            });
        });

        describe('#greets', function() {
            it('should throw if no target is passed in', function() {
                expect(function() {
                    (new Cow()).greets();
                }).to.throw(Error);
            });

            it('should greet passed target', function() {
                var greetings = (new Cow('Kate')).greets('Baby');
                expect(greetings).to.equal('Kate greets Baby');
            });
        });

        describe('#lateGreets', function() {
            this.timeout(15000);
            it('should pass an error if no target is passed', function(done) {
                (new Cow()).lateGreets(null, function(err) {
                    expect(err).to.be.an.instanceof(Error);
                    done();
                });
            });

            it('should greet passed target after one second', function(done) {
                (new Cow('Kate')).lateGreets('Baby', function(err, greetings) {
                    expect(greetings).to.equal('Kate greets Baby');
                    done();
                });
            });
        });

        // // Sinon stubbed
        // describe('#consoleGreets', function() {
        //     it('should log an error if no target is passed in', function() {
        //         (new Cow()).greets();

        //         this.assert.notCalled(console.log);
        //         this.assert.calledOnce(console.error);
        //         this.assert.calledWithExactly(console.error, 'missing target')
        //     });

        //     it('should log greetings', function() {
        //         var greetings = (new Cow('Kate')).greets('Baby');

        //         this.assert.notCalled(console.error);
        //         this.assert.calledOnce(console.log);
        //         this.assert.calledWithExactly(console.log, 'Kate greets Baby')
        //     });
        // });
    });
})();
